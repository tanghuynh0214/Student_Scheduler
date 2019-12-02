// -----------------SS-008---------------------------//

// Calculating Date
var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

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

console.log('before val');
console.log('beginDate: ' + beginDate);

currMonthLastDay = new Date(currYear,currMonth+1, 0).getDate();       // grabs the last day of current month
console.log('currMonthLD' + currMonthLastDay);

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
console.log('loop');
// Calculate the rest of dynamic dates starting from sunday
for(var i = 0; i < 7; i++)
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
}
