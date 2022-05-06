
<!DOCTYPE html>
<html>
    <head>
        <meta CHARSET="UTF-8">
            <title>Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </head>
    <body>
        <?php
        $quest = array(
          'Accordion Item #1' => 'Ans1',
          'Accordion Item #2' => 'Ans2',
           'Accordion Item #3' => 'Ans3',
           'Accordion Item #4' => 'Ans4',
           'Accordion Item #5' => 'Ans5',
           'Accordion Item #6' => 'Ans6',
           'Accordion Item #7' => 'Ans7',
           'Accordion Item #8' => 'Ans8',
           'Accordion Item #9' => 'Ans9',
           'Accordion Item #10' => 'Ans10'

          );
        $index =0; 
    ?>

       

        <hr>
        <header>
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup" style="background-color:blue;">
                <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                <a class="nav-link active" href="Registration.php">Registration</a>
                <a class="nav-link active" href="Courses.php">Courses</a>
                <a class="nav-link active" href="Payment.php">Payment</a>
                <a class="nav-link active" href="Aboutus.php">About Us</a>
                <a class="nav-link active" href="FAQ.php">FAQ</a>
                </div>
            </div>
            </div>
          </nav>
        </header>
      
        <!-- adding Accordion- which is the framework for the FAQ page-->
        <div class="container">
        <?php foreach($quest as $key => $value): ?>
        <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#quest<?php echo $index; ?>" aria-expanded="false" aria-controls="quest<?php echo $index; ?>">
      <?php echo $value; ?>
      </button>
    </h2>
    <div id="quest<?php echo $index; ?>" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      <?php echo $key; ?>
       
      </div>
    </div>
  </div>
  
</div>
<?php $index++; ?>
<?php endforeach; ?>
</div>

    </body>
</html>