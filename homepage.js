console.log("hello word");
// ---------------Creating a table for homepage.html------------------
var header = ["Time Period", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
var table = '';
var row = 11;
var col = 8;
var startTime = 8;                //start time variable used for calculations
var actualTime = 0;               //actual time variable being displayed

// table.setAttribute('id', 'calender');

// For loop to create a header of table
for(var i = 0; i < col; i++)
{
  table += '<th>' + header[i] + '</th>';
}

// For loop to create data cells of table
for(var i = 0; i < row; i++)
{
  table += '<tr>';
  for(var j = 0; j < col; j++)
  {
    // Time period
    if(j==0)
    {
      actualTime = (startTime + j) % 12;
      if(startTime <= 12 && actualTime < 10)
      {
        table += '<td>' + '0' + actualTime + ':00 AM' + '</td>';
      }
      else if(startTime <= 12 && actualTime >= 10)
      {
        table += '<td>' + actualTime + ':00 AM' + '</td>';
      }
      else if(startTime <= 24 && actualTime < 10)
      {
          table += '<td>' + '0' + actualTime + ':00 PM' + '</td>';
      }
      else if(startTime < 24 && actualTime >= 10)
      {
        table += '<td>' + actualTime + ':00 PM' + '</td>';
      }
      startTime++;
    }
    else
    {
      table += '<td>' + '' + '</td>';
    }
  }
  table += '</tr>';
}
document.write("<table border = '1' id = 'calender'>" + table + '</table>');
