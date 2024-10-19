<DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" href="../../../public/css/vendor/style.css">

        <?php
            $month = $_GET['month'];
            $year = $_GET['year'];
            $day = $_GET["day"];
            $startTime = $_GET["startTime"];
            $endTime = $_GET["endTime"];
            $startDay = $_GET["startDay"];
            $endDate = $_GET["endDate"];
        ?>
    </head>
    <body>
        <div class = "scheduleSelector card">
            <header class = "scheduleHeader card">
                <h3>October 2024</h3>
            </header>

            <table>
                    <thead>
                        <tr>
                            <th>SUN</th>
                            <th>MON</th>
                            <th>TUE</th>
                            <th>WED</th>
                            <th>THU</th>
                            <th>FRI</th>
                            <th>SAT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> </td>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>21</td>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                            <td>27</td>
                        </tr>
                        <tr>
                            <td>28</td>
                            <td>29</td>
                            <td>30</td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                    </tbody>
            </table>
            <div class = "time-div">
                <p>Start Time</p>

                <div class="right-side">
                    <div class="card">
                        <p>11:30</p>
                    </div>
                    <div class="card">
                        <input class="radio-button" type="radio" name="time" hidden>
                        <span class="custom-radio"></span> option 1
                    </div>
                </div>
            </div>

            <div class = "time-div" >
                <p>End Time</p>

                <div class = "right-side">

                </div>
            </div>
        </div>
    </body>
</html>