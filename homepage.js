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
var currDay = date.getDay();
var currDate = date.getDate();
// var currDate = 15;

var prevMonth = '';
var prevDay = '';
var prevDate = '';

var nextMonth;
var nextDay;
var nextDate;

console.log(currMonth);
console.log(currDay);
console.log(currDate);

var counter = 0;
var DAYS_IN_WEEK = 7;

//start dates on sunday
beginDate = currDate - currDay;
beginDay = currDay - currDay;

if(beginDate < 1)
{

}

// For loop to create a header of table
for(var i = 0; i < col; i++)
{
  if(i==1)
  {
    table += '<th>' + header[i] + '</th>';
  }
  else if(i!=1)
  {
    if(i==)
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
