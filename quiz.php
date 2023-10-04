<?php
include 'templates/header.php';

?>
<header class="header">
    <div class="container">
        <div class="section_full">
            <h1>QUIZ</h1>
        </div>
    </div>
</header>
<div class="quiz">

    <div class="container">
        <h1>Quiz Title</h1>
        <form action="process_quiz.php" method="post" id="quizForm">
            <div id="questionsContainer" class="question-container"></div>
            <button id="prevButton" class="nav-button" onclick="prevQuestion()">Previous</button>
            <button id="nextButton" class="nav-button" onclick="nextQuestion()">Next</button>
        </form>

    </div>
</div>

<?php include_once 'templates/footer.php' ?>