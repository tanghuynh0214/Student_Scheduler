console.log("hello word");
// ---------------Creating a table for homepage.html------------------
var header = ["Time Period", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
var table = '';
var rows = 11;
var col = 8;

for(var i = 0; i < col; i++)
{
  table += '<th>' + i + '</th>';
}
document.write('<table>' + table + '</table>');
