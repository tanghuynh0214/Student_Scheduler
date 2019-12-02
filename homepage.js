// ---------------Creating a table for homepage.html------------------
var header = ["Time Period", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

var table = '';
var row = 11;
var col = 8;
var startTime = 8;                //start time variable used for calculations
var miliTime = 0;
var actualTime = 0;               //actual time variable being displayed

// Calculating Date
var date = new Date();
var beginDate = '';
var beginDay = '';
var beginMonth = '';
var beginYear = '';

var prevMonthLastDay = '';
var currMonthLastDay = '';

var currYear = date.getFullYear();
var currMonth = date.getMonth();
var currDay = date.getDay();
var currDate = date.getDate();

console.log(currYear);
console.log(currMonth);
console.log(currDay);
console.log(currDate);


var counter = 0;
var DAYS_IN_WEEK = 7;

// Begin dates on sunday
beginYear = currYear;
beginMonth = currMonth;
beginDate = currDate - currDay;
beginDay = currDay - currDay;

// Validate if date carries to previous month
if(beginDate < 1)
{
  console.log('Nuuuu');
  prevMonthLastDay = new Date(currYear,currMonth, 0).getDate();          // grabs last day of previous month
  beginDate = beginDate + prevMonthLastDay;
  beginMonth--;
  console.log('beginMonth: '+beginMonth);
  console.log('beginDate: ' + beginDate);

  //Validate if the month carries to previous year
  if(beginMonth < 0)
  {
    beginMonth = beginMonth + 12;
    beginYear--;
  }
}

 // Grabs the last day of current month
currMonthLastDay = new Date(currYear,currMonth+1, 0).getDate();

// For loop to create a header of table
for(var i = 0; i < col; i++)
{
  if(i==0)
  {
    table += '<th>' + header[i] + '</th>';
  }
  else if (i!=0)
  {
    console.log('pre:' + beginDate);
    beginDay++;
    beginDate++;

    // Validate if date carries to next month
    if(beginDate > currMonthLastDay)
    {
      console.log('next Month!');
      beginDate = beginDate - currMonthLastDay;
      beginMonth++;
      currMonthLastDay = new Date(beginYear,beginMonth+1, 0).getDate();       // grabs the last day of current month

      // Validate if month carries over to next year
      if(beginMonth > 11)
      {
        beginMonth = beginMonth % 12;
        beginYear++;
      }
    }
    table += '<th>' + header[i] + '<br> ' + (beginMonth + 1) + '/' + beginDate + '</th>';
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
