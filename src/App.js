import React from 'react';
import logo from './logo.svg';
import './App.css';

function App() {
  return (
    /*<head>
      <title>Student Scheduler</title>
      <link rel="stylesheet" type = "text/css" href="homepage.css">
      <div id = "header">
        <p> Student Schedular </p>
      </div>
    </head>*/

      <div id="scheduler">
        <table id = "calender">
          {/*<!-- Header row -->
  */}        <tr>
            <th id = "timePeriod">Time Period</th>
            <th id = "sunday">Sunday</th>
            <th id = "monday">Monday</th>
            <th id = "tuesday">Tuesday</th>
            <th id = "wednesday">Wednesday</th>
            <th id = "thursday">Thursday</th>
            <th id = "friday">Friday</th>
            <th id = "saturday">Saturday</th>
          </tr>
    
          {/*<!-- 1AM Data row -->
*/}          <tr>
            <td class = "cell"> 01:00 AM </td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
          </tr>
    
          {/*<!-- 2AM Data row -->
*/}          <tr>
            <td class = "cell"> 02:00 AM </td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
          </tr>
    
          {/*<!-- 3AM Data row -->
*/}          <tr>
            <td class = "cell"> 03:00 AM </td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
          </tr>
    
          {/*<!-- 4AM Data row -->
*/}          <tr>
            <td class = "cell"> 04:00 AM </td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
          </tr>
    
          {/*<!-- 5AM Data row -->
*/}          <tr>
            <td class = "cell"> 05:00 AM </td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
          </tr>
    
          {/*<!-- 6AM Data row -->
*/}          <tr>
            <td class = "cell"> 06:00 AM </td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
          </tr>
    
          {/*<!-- 7AM Data row -->
*/}          <tr>
            <td class = "cell"> 07:00 AM </td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
          </tr>
    
          {/*<!-- 8AM Data row -->
*/}          <tr>
            <td class = "cell"> 08:00 AM </td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
          </tr>
    
          {/*<!-- 9AM Data row -->*/}          
          <tr>
            <td class = "cell"> 09:00 AM </td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
          </tr>
    
          {/*<!-- 10AM Data row -->*/}
          <tr>
            <td class = "cell"> 10:00 AM </td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
          </tr>
    
          {/*<!-- 11AM Data row -->*/}
          <tr>
            <td class = "cell"> 11:00 AM </td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
          </tr>
    
          {/*<!-- 12PM Data row -->*/}
          <tr>
            <td class = "cell"> 12:00 AM </td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
            <td class = "cell"></td>
          </tr>
    
            {/*<!-- 1PM Data row -->*/}            
            <tr>
              <td class = "cell"> 01:00 PM </td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
            </tr>
    
            {/*<!-- 2PM Data row -->*/}            
            <tr>
              <td class = "cell"> 02:00 PM </td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
            </tr>
    
            {/*<!-- 3PM Data row -->*/}            
            <tr>
              <td class = "cell"> 03:00 PM </td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
            </tr>
    
            {/*<!-- 4PM Data row -->*/}            
            <tr>
              <td class = "cell"> 04:00 PM </td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
            </tr>
    
            {/*<!-- 5PM Data row -->*/}            
            <tr>
              <td class = "cell"> 05:00 PM </td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
            </tr>
    
            {/*<!-- 6PM Data row -->*/}            
            <tr>
              <td class = "cell"> 06:00 PM </td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
            </tr>
    
            {/*<!-- 7PM Data row -->*/}            
            <tr>
              <td class = "cell"> 07:00 PM </td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
            </tr>
    
            {/*<!-- 8PM Data row -->*/}            
            <tr>
              <td class = "cell"> 08:00 PM </td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
            </tr>
    
            {/*<!-- 9PM Data row -->*/}            
            <tr>
              <td class = "cell"> 09:00 PM </td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
            </tr>
    
            {/*<!-- 10PM Data row -->*/}
            <tr>
              <td class = "cell"> 10:00 PM </td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
            </tr>
    
            {/*<!-- 11PM Data row -->*/}
            <tr>
              <td class = "cell"> 11:00 PM </td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
            </tr>
    
            {/*<!-- 12AM Data row -->*/}
            <tr>
              <td class = "cell"> 12:00 AM </td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
              <td class = "cell"></td>
          </tr>
        </table>
      </div>

    /*<div className="App">
      <header className="App-header">
        <img src={logo} className="App-logo" alt="logo" />
        <p>
          Edit <code>src/App.js</code> and save to reload.
        </p>
        <a
          className="App-link"
          href="https://reactjs.org"
          target="_blank"
          rel="noopener noreferrer"
        >
          Learn React
        </a>
      </header>
    </div>*/
  );
}

export default App;
