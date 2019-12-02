var header = ["Time Period", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
var rowCell = ["tblRow1", "tblRow2", "tblRow3", "tblRow4", "tblRow5", "tblRow6", "tblRow7", "tblRow8", "tblRow9", "tblRow10"];

var OFFSET = 1;

var startTime = 8;                //start time variable used for calculations
var miliTime = 0;
var actualTime = 0;               //actual time variable being displayed

var sundayCol, mondayCol, tuesdayCol, wednesdayCol, thursdayCol, fridayCol, saturdayCol = '';
var cellSunday, cellMonday, cellTuesday, cellWednesday, cellThursday, cellFriday, cellSaturday = '';
var timeOne, timeTwo, timeThree, timeFour, timeFive, timeSix, timeSeven, timeEight, timeNine, timeTen = '';
var slotOne, slotTwo, slotThree, slotFour = '';

// creating table and seting setting attribute
var scheduler = document.createElement('table');
scheduler.setAttribute('id', 'calender');
document.getElementById('scheduler').appendChild(scheduler);

// creating table row (header)
var headerRow = document.createElement('tr');
headerRow.setAttribute('id', 'tblHeader');
document.getElementById('calender').appendChild(headerRow);

var timeCol = document.createElement('td');
var cell = document.createTextNode(header[0]);
timeCol.appendChild(cell);
document.getElementById('tblHeader').appendChild(timeCol);

// Calculating date
var date = new Date();
var currMonth = date.getMonth();
var currDate = date.getDate();
// var currDay = date.getDay();
var currDay = 5;
console.log(currMonth);
console.log(currDay);
console.log(currDate);

var counter = 0;
var DAYS_IN_WEEK = 7;

while(counter < DAYS_IN_WEEK)
{
  console.log('whyy');
  var lineBreak = document.createElement('br');
  var dyDate = document.createTextNode((currMonth + OFFSET) + '/' + currDate);

  if(currDay == 0)
  {
    sundayCol = document.createElement('td');
    sundayCol.setAttribute('id','sunday');
    cellSunday = document.createTextNode(days[currDay]);
    sundayCol.appendChild(cellSunday);
    sundayCol.appendChild(lineBreak);
    sundayCol.appendChild(dyDate);
    document.getElementById('tblHeader').appendChild(sundayCol);
  }
  else if(currDay == 1)
  {
    mondayCol = document.createElement('td');
    mondayCol.setAttribute('id','monday');
    cellMonday = document.createTextNode(days[currDay]);
    mondayCol.appendChild(cellMonday);
    mondayCol.appendChild(lineBreak);
    mondayCol.appendChild(dyDate);
    document.getElementById('tblHeader').appendChild(mondayCol);
  }
  else if(currDay == 2)
  {
    tuesdayCol = document.createElement('td');
    tuesdayCol.setAttribute('id','tuesday');
    cellTuesday = document.createTextNode(days[currDay]);
    tuesdayCol.appendChild(cellTuesday);
    tuesdayCol.appendChild(lineBreak);
    tuesdayCol.appendChild(dyDate);
    document.getElementById('tblHeader').appendChild(tuesdayCol);
  }
  else if (currDay == 3)
  {
    wednesdayCol = document.createElement('td');
    wednesdayCol.setAttribute('id','wednesday');
    cellWednesday = document.createTextNode(days[currDay]);
    wednesdayCol.appendChild(cellWednesday);
    wednesdayCol.appendChild(lineBreak);
    wednesdayCol.appendChild(dyDate);
    document.getElementById('tblHeader').appendChild(wednesdayCol);
  }
  else if (currDay == 4)
  {
    thursdayCol = document.createElement('td');
    thursdayCol.setAttribute('id','thursday');
    cellThursday = document.createTextNode(days[currDay]);
    thursdayCol.appendChild(cellThursday);
    thursdayCol.appendChild(lineBreak);
    thursdayCol.appendChild(dyDate);
    document.getElementById('tblHeader').appendChild(thursdayCol);
  }
  else if (currDay == 5)
  {
    fridayCol = document.createElement('td');
    fridayCol.setAttribute('id','friday');
    cellFriday = document.createTextNode(days[currDay]);
    fridayCol.appendChild(cellFriday);
    fridayCol.appendChild(lineBreak);
    fridayCol.appendChild(dyDate);
    document.getElementById('tblHeader').appendChild(fridayCol);
  }
  else if (currDay == 6)
  {
    saturdayCol = document.createElement('td');
    saturdayCol.setAttribute('id','saturday');
    cellSaturday = document.createTextNode(days[currDay]);
    saturdayCol.appendChild(cellSaturday);
    saturdayCol.appendChild(lineBreak);
    saturdayCol.appendChild(dyDate);
    document.getElementById('tblHeader').appendChild(saturdayCol);
  }
  counter++;
  currDate++;
  currDay = (currDay + 1) % 7;
}

//Creating data cells of table
for(var i = 0; i < 11; i++)
{
  // creating table row (cells)
  var cellRow = document.createElement('tr');
  cellRow.setAttribute('id', rowCell[i]);
  document.getElementById('calender').appendChild(cellRow);
  for(var j = 0; j < 8; j++)
  {
    var dataCell = document.createElement('td');
    dataCell.setAttribute('class','dataCells');
    document.getElementById(rowCell[i]).appendChild(dataCell);
    // if(j==0)
    // {
      // miliTime = (startTime + j) % 24;
      // actualTime = miliTime % 12;
      //
      // if((miliTime < 12 || miliTime == 24) && actualTime < 10)
      // {
      //   timeOne = document.createElement('td');
      //   timeOne.setAttribute('id','timeOne');
      //   slotOne = document.createTextNode('0' + actualTime + ':00 AM');
      //   timeOne.appendChild(slotOne);
      //   document.getElementById('calender').appendChild(slotOne);
      // }
      // else if((miliTime < 12 || miliTime == 24) && actualTime >= 10)
      // {
      //   timeTwo = document.createElement('td');
      //   timeTwo.setAttribute('id','timeTwo');
      //   slotTwo = document.createTextNode(actualTime + ':00 AM');
      //   timeTwo.appendChild(slotTwo);
      //   document.getElementById('calender').appendChild(slotTwo);
      // }
      // else if ((miliTime < 24 || miliTime == 12)  && actualTime < 10)
      // {
      //   timeThree = document.createElement('td');
      //   timeThree.setAttribute('id','timeThree');
      //   slotThree = document.createTextNode('0' + actualTime + ':00 PM');
      //   timeThree.appendChild(slotThree);
      //   document.getElementById('calender').appendChild(slotThree);
      // }
      // else if ((miliTime < 24 || miliTime == 12) && actualTime >= 10)
      // {
      //   timeFour = document.createElement('td');
      //   timeFour.setAttribute('id','timeFour');
      //   slotFour = document.createTextNode(actualTime + ':00 PM');
      //   timeFour.appendChild(slotFour);
      //   document.getElementById('calender').appendChild(slotFour);
      // }
      // startTime++;

    // }
    // else
    // {
    //   var dataCell = document.createElement('td');
    //   dataCell.setAttribute('class','dataCells');
    //   document.getElementById(rowCell[i]).appendChild(dataCell);
    // }

  }
}
