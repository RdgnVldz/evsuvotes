<!DOCTYPE html>
<html>
<head>
    <!-- Add this to the <head> section of your HTML file -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
      max-width: 800px;
      margin: 0 auto;
      padding: 10px;
      background-position: center;
      background-size: 100% 100%;
      background-repeat: no-repeat;
      color: #fff;
      background-color: rgba(0, 0, 0, 0.5);
    }
    h1 {
      text-align: center;
    }

    div {
      padding: 10px;
      border: 1px solid #ccc;
      margin: 5px;
    }

    /* Adjust styles for smaller screens */
    @media (max-width: 768px) {
      body {
        padding: 10px;
        background-image: url('../images/bg7p.png');
        background-attachment: fixed;
        background-size: 100% 100%;
      }
      div {
        margin: 5px;
      }
    }
    .center-button {
            text-align: center;
        }
  </style>
</head>
<body>
  <h1>Terms and Conditions</h1>
  <div>
    <p><strong>1. Who Can Vote?</strong></p>
    <p>Only students from the relevant department or school can vote.</p>
  </div>
  
  <div>
    <p><strong>2. Register to Vote:</strong></p>
    <p>Make sure each student is who they claim to be, using methods like student IDs or email verification.</p>
  </div>

  <div>
    <p><strong>3. Verify Voters</strong></p>
    <p>Students need to sign up to vote, and the information they provide must be accurate.</p>
  </div>

  <div>
    <p><strong>4. Voting Time</strong></p>
    <p>Choose a specific date and time for voting, and let everyone know when it will happen.</p>
  </div>

  <div>
    <p><strong>4. Pick Candidates</strong></p>
    <p>Set rules for students to nominate themselves as candidates, like gathering signatures from fellow students.</p>
  </div>

  <div>
    <p><strong>4. Keep Votes Secret</strong></p>
    <p>Make sure no one can see how others voted to maintain secrecy.</p>
  </div>

  <div>
    <p><strong>4. One Vote Per Person</strong></p>
    <p>Prevent students from voting multiple times.</p>
  </div>

  <div>
    <p><strong>4. Handle Problems</strong></p>
    <p>Have a way to address complaints and disagreements.</p>
  </div>

  <div>
    <p><strong>4. Respect Privacy</strong></p>
    <p>Follow privacy laws and school policies for handling data.</p>
  </div> 

  <div class="center-button">
        <button class="btn btn-info" id="goBackButton">Go Back</button>
    </div>
  <script>
        document.getElementById("goBackButton").addEventListener("click", function() {
            window.history.back();
        });
    </script>
</body>
</html>
