import React from 'react';
import logo from './logo.svg';
import './App.css';

function timeRow(time){
  return (
  <tr>
    <td class = "cell"> {time % 12 === 0 ? 12 : time % 12}:00 {time - 12 < 0 ? "AM" : "PM"} </td>
    <td class = "cell"></td>
    <td class = "cell"></td>
    <td class = "cell"></td>
    <td class = "cell"></td>
    <td class = "cell"></td>
    <td class = "cell"></td>
    <td class = "cell"></td>
  </tr>
  );
}

function timeRows(){
  var rows = []
  var earlyBound = 0;//[0,23] and earlyBound < lateBound
  var lateBound = 23;//[0,23] and earlyBound < lateBound
  for(var i = earlyBound; i < lateBound + 1; i++) {
    rows.push(timeRow(i));
  }
  return rows;
}

function App() {
  return (
    <div id="scheduler">
      <table id = "calender">
        {/*<!-- Header row -->*/}        
        <tr>
          <th id = "timePeriod">Time Period</th>
          <th id = "sunday">Sunday</th>
          <th id = "monday">Monday</th>
          <th id = "tuesday">Tuesday</th>
          <th id = "wednesday">Wednesday</th>
          <th id = "thursday">Thursday</th>
          <th id = "friday">Friday</th>
          <th id = "saturday">Saturday</th>
        </tr>

        {timeRows()}

      </table>
    </div>
  );
}

export default App;
