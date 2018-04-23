// https://codeburst.io/an-introduction-to-web-scraping-with-node-js-1045b55c63f7
const rp = require('request-promise');
const cheerio = require('cheerio');
const jsonfile = require('jsonfile');

// Small helper to return evaluable HTML via cheerio
const options = {
  uri: `https://www.transilien.com/#info-trafic-temps-reel`,
  transform: function (body) {
    return cheerio.load(body);
  }
};

function escapeHtml(unsafe) {
    return unsafe
         .replace(/\t/g, "&nbsp;")
         .replace(/\n/g, "");
}

const lines = ['A', 'B', 'C', 'D', 'E', 'H', 'J', 'K', 'L', 'N', 'P', 'U'];
const data = {disruption: []};

// Make the request
rp(options)
    .then(($) => {
        lines.forEach((line) => {
            let html = $('#b_info_trafic').find(`#detail-trafic-${line}`);
            let status = html.find('h3').find('span:last-child').text();
            data.disruption.push({
                line: `${line}`,
                status: status,
            });
        });
        return data;
    })
    .then(data => {
        let file = '/home/nimda/app/json/data.json';
        jsonfile.writeFile(file, data, {spaces: 2}, function(err) {console.error(err);});
    })
    .catch((err) => {
        console.error(err);
    });

