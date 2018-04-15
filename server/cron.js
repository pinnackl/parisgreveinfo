const { google } = require("googleapis");
const axios = require('axios');
const http = require("https");

// Load the service account key JSON file.
const serviceAccount = require("./config.json");

// Define the required scopes.
const  scopes = [
  "https://www.googleapis.com/auth/userinfo.email",
  "https://www.googleapis.com/auth/firebase.database"
];

// Authenticate a JWT client with the service account.
const jwtClient = new google.auth.JWT(
  serviceAccount.client_email,
  null,
  serviceAccount.private_key,
  scopes
);

// Use the JWT client to generate an access token.
jwtClient.authorize(function(error, tokens) {
  if (error) {
    console.log("Error making request to generate access token:", error);
  } else if (tokens.access_token === null) {
    console.log("Provided service account does not have permission to generate access tokens");
  } else {
    const accessToken = tokens.access_token;

    // See the "Using the access token" section below for information
    // on how to use the access token to send authenticated requests to
    // the Realtime Database REST API.
    // console.log("token : ", accessToken);
    axios.get(`${serviceAccount.httpEndpoint}/users.json?access_token=${accessToken}`, {responseType: 'json'})
      .then(response => {
        const users = response.data;
        return tokens = Object.keys(users).map((key) => { return users[key].token });
      })
      .then(tokens => {
        console.log(tokens);
        tokens.forEach(token => {
          if (token == "null") return;
          var options = {
            "method": "POST",
            "hostname": "fcm.googleapis.com",
            "port": null,
            "path": "/fcm/send",
            "headers": {
              "authorization": `key=${serviceAccount.token}`,
              "content-type": "application/json",
              "cache-control": "no-cache",
            }
          };

          var req = http.request(options, function (res) {
            var chunks = [];

            res.on("data", function (chunk) {
              chunks.push(chunk);
            });

            res.on("end", function () {
              var body = Buffer.concat(chunks);
              console.log(JSON.parse(body.toString()).success);
            });
          });

          // For more information see,
          // https://developers.google.com/web/fundamentals/push-notifications/display-a-notification
          req.write(JSON.stringify({
            "to": token,
            "notification": {
              "badge": '/images/manifest/badge.png',
              "title": '🚅 Paris grève info',
              "vibrate": [2000, 100, 2000, 100, 2000],
              "body": '😱 La grève se poursuit demain !\nLes mouvements sociaux débutent généralement la veille vers 19 heures.',
              "click_action": "https://parisgreve.info",
              "icon": '/images/manifest/icon-96x96.png'
            }
          }));
          req.end();
        });
      })
      .catch(error => {
        console.log(error);
      });

  }
});