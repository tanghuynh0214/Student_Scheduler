console.log("hello word");
// ---------------Creating a table for homepage.html------------------
var header = ["Time Period", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

var table = '';
var row = 11;
var col = 8;
var startTime = 8;                //start time variable used for calculations
var miliTime = 0;
var actualTime = 0;               //actual time variable being displayed

// Calculating Date
var date = new Date();
var currMonth = date.getMonth();
var currDay = 1;
// var currDate = date.getDate();
var currDate = 15;

var prevMonth = '';
var prevDay = '';
var prevDate = '';

var nextMonth;
var nextDay;
var nextDate;

console.log(currMonth);
console.log(currDay);
console.log(currDate);

// For loop to create a header of table
for(var i = 0; i < col; i++)
{
  if(i == 0)
  {
    table += '<th>' + header[i] + '</th>';
  }
  else if(i != 0)
  {
    if(currDay == 0)
    {
      table += '<th>' + header[1] + '<br>' + currDate + 1 + '</th>';
    }
    else if (currDay == 1)
    {
      table += '<th>' + header[2] + '<br>' + currDate + 2 + '</th>';

    }
    else if (currDay == 2)
    {
      table += '<th>' + header[3] + '<br>' + currDate + 3 + '</th>';
    }
    else if (currDay == 3)
    {
      table += '<th>' + header[4] + '<br>' + currDate + 4 + '</th>';
    }
    else if (currDay == 4)
    {
      table += '<th>' + header[5] + '<br>' + currDate + 5 + '</th>';
    }
    else if (currDay == 5)
    {
      table += '<th>' + header[6] + '<br>' + currDate + 6 + '</th>';
    }
    else if (currDay == 6)
    {
      table += '<th>' + header[7] + '<br>' + currDate + 7 + '</th>';
    }
    currDay++;
    currDate++;
  }
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
      miliTime = (startTime + j) % 24;
      actualTime = miliTime % 12;
      if((miliTime < 12 || miliTime == 24) && actualTime < 10)
      {
        table += '<td>' + '0' + actualTime + ':00 AM' + '</td>';
      }
      else if((miliTime < 12 || miliTime == 24) && actualTime >= 10)
      {
        table += '<td>' + actualTime + ':00 AM' + '</td>';
      }
      else if((miliTime < 24 || miliTime == 12)  && actualTime < 10)
      {
          table += '<td>' + '0' + actualTime + ':00 PM' + '</td>';
      }
      else if((miliTime < 24 || miliTime == 12) && actualTime >= 10)
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
