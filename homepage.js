// ---------------Creating a table for homepage.html------------------
var header = ["Time Period", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];

var table = '';
var row = 11;
var col = 6;
var startTime = 8;                //start time variable used for calculations
var miliTime = 0;
var actualTime = 0;               //actual time variable being displayed

// Calculating Date
var date = new Date();

var counter = 0;
var DAYS_IN_WEEK = 7;

// Begin dates on sunday

var curr = new Date; // get current date
var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week

var firstday = new Date(curr.setDate(first)); // Should contain the date of Sunday

var day = 1; // Used as an offset. If you want your calender to start on Sunday, day = 0. If you want it to start on Monday, day = 1

for(var i = 0; i < header.length; i++)
{
  if(i==0)
  {
    table += '<th>' + header[i] + '</th>';
  }
  else if (i!=0)
  {
    table += '<th>' + header[i] + '<br> ' + (firstday.getMonth() + 1) + '/' + (firstday.getDate() + day++) + '</th>';
  }
}


// For loop to create data cells of table
/*for(var i = 0; i < row; i++)
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
    	if(actualTime == 0) //This if else statement here is purely so that the time does not output as 00:00 PM instead of 12:00 PM
      		table += '<td>' + '12' + ':00 PM' + '</td>';
      	else
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
}*/
document.write(table);
