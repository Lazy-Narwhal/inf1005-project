<<<<<<< HEAD
<!-- Template from Colorlib https://colorlib.com/wp/template/calendar-04/ -->
<div class="row">
    <div class="content w-100">
        <div class="calendar-container">
            <div class="calendar table-responsive">
            <!-- TODO: FIGURE OUT WHERE TO PLACE SMALL YEAR, ENSURE ONLY FUTURE DATES CAN BE PICKED --> 
            <div class="month-header"> 
              <span class="left-button fa fa-chevron-left" id="prev">&lt;</span>
                <span class="month" id="label"></span>
                <span class="right-button fa fa-chevron-right" id="next">&gt; </span>
            </div>
            <!-- <table class="months-table w-100"> 
=======
<!-- Credits to Colorlib -->
<div class="row">
    <div class="col-md-12">
        <div class="content w-100">
        <div class="calendar-container">
            <div class="calendar table-responsive">
            <!-- TODO: ADD SMALL YEAR, ENLARGE MONTHS, FIX DAYS COLOR, ENSURE ONLY FUTURE DATES CAN BE PICKED --> 
            <!-- <div class="year-header">  -->
            <!--   <span class="left-button fa fa-chevron-left" id="prev"> </span> -->
            <!--     <span class="year" id="label"></span> -->
            <!--     <span class="right-button fa fa-chevron-right" id="next"> </span> -->
            <!-- </div> -->
            <table class="months-table w-100"> 
>>>>>>> parent of 6ce9845 (Revert "bookings page first half")
                <tbody>
                <tr class="months-row">
                    <td class="month">Jan</td> 
                    <td class="month">Feb</td> 
                    <td class="month">Mar</td> 
                    <td class="month">Apr</td> 
                    <td class="month">May</td> 
                    <td class="month">Jun</td> 
                    <td class="month">Jul</td>
                    <td class="month">Aug</td> 
                    <td class="month">Sep</td> 
                    <td class="month">Oct</td>          
                    <td class="month">Nov</td>
                    <td class="month">Dec</td>
                </tr>
                </tbody>
<<<<<<< HEAD
            </table>  -->
=======
            </table> 
>>>>>>> parent of 6ce9845 (Revert "bookings page first half")

            <table class="table table-bordered table-dark text-center"> 
                <td class="table-primary">Sun</td> 
                <td class="table-primary">Mon</td> 
                <td class="table-primary">Tue</td> 
                <td class="table-primary">Wed</td> 
                <td class="table-primary">Thu</td> 
                <td class="table-primary">Fri</td> 
                <td class="table-primary">Sat</td>
            </table> 
            <div class="frame"> 
                <table class="dates-table w-100"> 
                    <tbody class="tbody">             
                    </tbody> 
                </table>
            </div> 
<<<<<<< HEAD
            <!-- <button class="button" id="add-button">Add Event</button> -->
            </div>
        </div>
        <div class="events-container">
            <!-- JS populates here -->
=======
            <button class="button" id="add-button">Add Event</button>
            </div>
        </div>
        <div class="events-container">
>>>>>>> parent of 6ce9845 (Revert "bookings page first half")
        </div>
        <div class="dialog" id="dialog">
            <h2 class="dialog-header"> Add New Event </h2>
            <form class="form" id="form">
                <div class="form-container flex">
                <label class="form-label" id="valueFromMyButton" for="name">Event name</label>
                <input class="input" type="text" id="name" maxlength="36">
                <label class="form-label" id="valueFromMyButton" for="count">Number of people to invite</label>
                <input class="input" type="number" id="count" min="0" max="1000000" maxlength="7">
                <input type="button" value="Cancel" class="button" id="cancel-button">
                <input type="button" value="OK" class="button button-white" id="ok-button">
                </div>
            </form>
<<<<<<< HEAD
=======
            </div>
>>>>>>> parent of 6ce9845 (Revert "bookings page first half")
        </div>
    </div>
</div>
