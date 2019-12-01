var header = ["Time Period", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

console.log(header[0]);

// creating table and seting setting attribute
var scheduler = document.createElement('table');
scheduler.setAttribute('id', 'calender');
document.body.appendChild(scheduler);

// creating table row (header)
var headerRow = document.createElement('tr');
headerRow.setAttribute('id', 'tblHeader');
document.getElementById('calender').appendChild(headerRow);

// loop through header list
for(var i = 0; i < 8; i++)
{
  if(i==0)
  {
    var timeCol = document.createElement('td');
    var cell = document.createTextNode(header[i]);
    timeCol.appendChild(cell);
    document.getElementById('tblHeader').appendChild(timeCol);
  }
  else if ( i==1)
  {
    var sundayCol = document.createElement('td');
    sundayCol.setAttribute('id','sunday');
    var cellSunday = document.createTextNode(header[i]);
    sundayCol.appendChild(cellSunday);
    document.getElementById('tblHeader').appendChild(sundayCol);
  }
  else if(i==2)
  {
    // var day1 = 23;
    // var lineBreak = document.createElement('br');
    var mondayCol = document.createElement('td');
    mondayCol.setAttribute('id','monday');
    // var one = document.createTextNode('1' + '/' + day1);
    var cellMonday = document.createTextNode(header[i]);
    mondayCol.appendChild(cellMonday);
    // mondayCol.appendChild(lineBreak);
    // mondayCol.appendChild(one);
    document.getElementById('tblHeader').appendChild(mondayCol);
  }
  else if(i==3)
  {
    var tuesdayCol = document.createElement('td');
    tuesdayCol.setAttribute('id','tuesday');
    var cellTuesday = document.createTextNode(header[i]);
    tuesdayCol.appendChild(cellTuesday);
    document.getElementById('tblHeader').appendChild(tuesdayCol);
  }
  else if (i==4)
  {
    var wednesdayCol = document.createElement('td');
    wednesdayCol.setAttribute('id','wednesday');
    var cellWednesday = document.createTextNode(header[i]);
    wednesdayCol.appendChild(cellWednesday);
    document.getElementById('tblHeader').appendChild(wednesdayCol);
  }
  else if (i==5)
  {
    var thursdayCol = document.createElement('td');
    thursdayCol.setAttribute('id','thursday');
    var cellThursday = document.createTextNode(header[i]);
    thursdayCol.appendChild(cellThursday);
    document.getElementById('tblHeader').appendChild(thursdayCol);
  }
  else if (i==6)
  {
    var fridayCol = document.createElement('td');
    fridayCol.setAttribute('id','friday');
    var cellFriday = document.createTextNode(header[i]);
    fridayCol.appendChild(cellFriday);
    document.getElementById('tblHeader').appendChild(fridayCol);
  }
  else if (i==7)
  {
    var saturdayCol = document.createElement('td');
    saturdayCol.setAttribute('id','saturday');
    var cellSaturday = document.createTextNode(header[i]);
    saturdayCol.appendChild(cellSaturday);
    document.getElementById('tblHeader').appendChild(saturdayCol);
  }
}

// Calculating date
var date = new Date();
var currMonth = date.getMonth();
var currDate = date.getDate();
var currDay = date.getDay();

console.log(currMonth);
console.log(currDay);
console.log(currDate);

var counter = 0;
var DAYS_IN_WEEK = 7;



// creating rest of data cells
// var par = document.createElement('paragraph');
// par.setAttribute('id','demo');
// document.body.appendChild(par);

// var date = new Date();
// var month = date.getMonth();
// var day = date.getDate();
// document.getElementById("demo").innerHTML = day;
//
// var today = new Date();
// // var lastDayOfMonth = new Date(today.getFullYear(), today.getMonth()+1, 0);
// var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
// document.getElementById("demo").innerHTML = firstDayOfMonth;
