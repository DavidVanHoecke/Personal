<html lang="en" >
<head>
    <Title>Welcome to Table en Ville - A social dining club experience</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Angular Material style sheet -->
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
  <!-- Angular Material requires Angular.js Libraries -->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>

  <!-- Angular Material Library -->
  <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-material-icons/0.7.1/angular-material-icons.min.js"></script> 
  
  <script src="https://use.fontawesome.com/ab34c2e899.js"></script>
  
  <!-- Your application bootstrap  -->
  <script type="text/javascript">    
    /**
     * You must include the dependency on 'ngMaterial' 
     */
    var app = angular.module('TeV', ['ngMaterial', 'ngMdIcons']);
    
    app.controller('TestCtrl', ['$scope', function ($scope) {
        
    }]);
  </script>
  
  <style>
      body{
            color: #999;
            background: red; /* For browsers that do not support gradients */
            background: -webkit-linear-gradient(top, red , yellow); /* For Safari 5.1 to 6.0 */
            background: -o-linear-gradient(top, red, yellow); /* For Opera 11.1 to 12.0 */
            background: -moz-linear-gradient(top, red, yellow); /* For Firefox 3.6 to 15 */
            background: linear-gradient(to top, #666 , #999); /* Standard syntax */
      }
      
      div{
          color: #333;
      }
  </style>
</head>
<body ng-app="TeV" ng-controller="TestCtrl" ng-cloak layout="column">
    <?php echo "sdmfjsdmfsdfsdfsdf" ?>
    <div layout="row" layout-align="center center">
        <div flex="75">
            <div layout="row">
    
                <div flex></div>
                <img src="img/Middel 1@2x.png" alt="" />
                <div flex></div>

            </div>
            <div layout="row" layout-align="center center">
                The site is currently under development, check back later! <?php
echo "Sum: ", 1 + 2;
echo "Hello ", isset($name) ? $name : "John Doe", "!"; ?>
            </div>
    
        </div>
    </div>
    <div layout="row">
        <md-card style="background-color: #FBC170;" flex>
            <md-card-content layout="column">
                <div layout="row" layout-align="center center">
                    <ng-md-icon icon="group" size="48" aria-label="Social dining"></ng-md-icon>
                    <h3 class="md-display-2">Social dining</h3>
                </div>
                <div layout="row" layout-align="center center">
                    At table en ville we believe that the fondest memories are made around the table. We want to bring as many people as possible together at the dining table to enjoy the taste of life. Because we look at the dining table as the original social network to meet new people based on interests and passions.
                </div>
            </md-card-content>
        </md-card>
        <md-card style="background-color: #F39672;" flex>
            <md-card-content layout="column">
                <div layout="row" layout-align="center center">
                    <ng-md-icon icon="local_dining" size="48" aria-label="Good food & great people"></ng-md-icon>
                    <h3 class="md-display-2">Good food, great people</h3>
                </div>
                <div>
                    Table en ville brings food with a story. Our online platform connects hosts and guests from diverse backgrounds to share good times. People who love to share their stories of living with others at the dining table.
                </div>
            </md-card-content>
        </md-card>
        <md-card style="background-color: #D93F15;" flex>
            <md-card-content layout="column">
                <div layout="row" layout-align="center center">
                <h3 class="md-display-2">Social dining</h3>
                </div>
                <div>
                    The site is currently under development, check back later!
                </div>
            </md-card-content>
        </md-card>
    </div>
    <div flex ></div>
    <div layout="row" layout-align="center center">contact@tableenville.com | &copy; 2017 Table en Ville | all rights reserved |&nbsp; <i class="fa fa-instagram" aria-hidden="true"></i>&nbsp;<i class="fa fa-facebook" aria-hidden="true"></i>&nbsp;<i class="fa fa-twitter" aria-hidden="true"></i>&nbsp;<br /><br /></div>
</body>
</html>
