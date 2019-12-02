// Calculating Date
var date = new Date();
var beginDate = '';
var beginDay = '';
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
  console.log('Nuuuu');
}
