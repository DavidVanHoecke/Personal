
    

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
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-route.js"></script>

        <!-- Angular Material Library -->
        <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-material-icons/0.7.1/angular-material-icons.min.js"></script> 
        <script src="https://use.fontawesome.com/ab34c2e899.js"></script>
        
        <!-- Your application bootstrap  -->
        <script type="text/javascript">
            /**
             * You must include the dependency on 'ngMaterial' 
             */
            var app = angular.module('TeV', ['ngMaterial', 'ngMdIcons', 'ngRoute']);
            app.controller('LandingCtrl', ['$scope', '$mdDialog', '$mdMedia', '$mdToast', 'mailService', function ($scope, $mdDialog, $mdMedia, $mdToast, mailService) {
            
            $scope.theme = 'lime';
            
            $scope.sayHi = "Say hi";
            
            $scope.triggerLanding = function(){
            dialogShowAdvanced(null, false, "landing-template.html", $scope, $mdMedia, $mdDialog);
            };

            //$scope.guest = {email: "david.vanhoecke@delair-tech.com", nameFirst: "David", nameLast : "Van Hoecke"};

            $scope.mailSent = false;
            $scope.sendMail = function(msg){
            var body = "Hi,\n\rThe following data was filled into the landing page form:\n\r";
            body += "Email: " + msg.email + "\n";
            body += "First name: " + msg.nameFirst + "\n";
            body += "Last name: " + msg.nameLast + "\n";
            body += "phone: " + msg.phone + "\n";
            body += "comments: " + msg.comments + "\n\r";
            body += "excel friendly: \n" + msg.email + ";" + msg.nameFirst + ";" + msg.nameLast + ";" + msg.phone + ";" + msg.comments + "\n\r";
            var mail = {
            to: "davidvanhoecke@gmail.com",
                    subject: "Landing page form entry",
                    body: body
            }

            mailService.doCmd(mail).then(function(response){
            //$scope.mailSent = true;
            msg = null;
            $scope.guest = null;
            showToast("Thank you for participating!", $mdToast);
            //sleep(2000).then(function(){
            $mdDialog.hide();
            //});
            }, function(err){
            alert(err);
            });
            //post("SendMail", {subject: "Test mail", body: msg, from: "david.vanhoecke@delair-tech.com", to: "david.vanhoecke@delair-tech.com"});
            }
            }]);
            app.service("mailService", function ($http) {
            // search ProductAssemblies
            this.doCmd = function (FormData) {
            var response = $http
                    ({
                    method: "post",
                            url: "mailer.php",
                            data: FormData,
                            dataType: "json"
                    });
            return response;
            }
            });
            /*app.config(function ($mdThemingProvider) {
            var customGreyMap = $mdThemingProvider.extendPalette('grey', {'contrastDefaultColor': 'light', 'contrastDarkColors': ['200'], '200': '795548'});
            $mdThemingProvider.definePalette('customGreyMap', customGreyMap);
            $mdThemingProvider.theme('default').primaryPalette('customGreyMap', {
            'default': '400',
                    'hue-1': '200'
            }).accentPalette('orange');
            $mdThemingProvider.theme('input', 'default').primaryPalette('grey');
            });*/
    
            app.config(function($mdThemingProvider) {
                $mdThemingProvider.theme('default')
                  .primaryPalette('brown')
                  .accentPalette('amber')
                  .warnPalette('orange');

                // This is the absolutely vital part, without this, changes will not cascade down through the DOM.
                $mdThemingProvider.alwaysWatchTheme(true);
              });
    
    /*
            function sleep(time) {
                return new Promise(function(resolve) => {setTimeout(resolve, time)});
            }
*/
            function dialogShowAdvanced(ev, clickOutsideToClose, template, $scope, $mdMedia, $mdDialog) {
            var useFullScreen = ($mdMedia('sm') || $mdMedia('xs')) && $scope.customFullscreen;
            $mdDialog.show({
            controller: DialogController,
                    templateUrl: template,
                    parent: angular.element(document.body),
                    targetEvent: ev,
                    clickOutsideToClose: true,
                    fullscreen: useFullScreen,
                    scope: $scope,
                    preserveScope: true,
            }).then(function (answer) {
            $scope.status = 'You closed (and submitted?) the dialog.';
            }, function () {
            $scope.status = 'You cancelled the dialog.';
            });
            $scope.$watch(function () {
            return $mdMedia('xs') || $mdMedia('sm');
            }, function (wantsFullScreen) {
            $scope.customFullscreen = (wantsFullScreen === true);
            });
            }

            function DialogController($scope, $mdDialog) {
            $scope.hide = function () {
            $mdDialog.hide();
            };
            $scope.cancel = function () {
            $mdDialog.cancel();
            };
            $scope.answer = function (answer) {
            $mdDialog.hide(answer);
            };
            $scope.login = function () {
            this.$mdDialog.hide();
            };
            }
            
             function showToast(content, $mdToast) {
                $mdToast.show($mdToast.simple().textContent(content).parent(document.querySelectorAll('#form')).position('top left'));
            }
            /*
             function post(cmd, data) {
             $.ajax({ type : 'POST',
             data : { cmd:cmd},
             url  : 'mailer.php', // <=== CALL THE PHP FUNCTION HERE.
             success: function (data) {
             alert(data); // <=== VALUE RETURNED FROM FUNCTION.
             }, error: function (xhr) {
             alert("error");
             }
             });
             } 
             */
        </script>

        <style>
            body, md-content, p{
                color: #7c7c7c;
            }

            .md-headline{
                color: #7c7c7c;
            }

            a.mail{
                color: #7c7c7c;
                text-decoration: none;
            }

            .gradientBg{
                background: #fff; /* For browsers that do not support gradients */
                background: -webkit-linear-gradient(top, #eaeced, #fff); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(top, #eaeced, #fff); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(top, #eaeced, #fff); /* For Firefox 3.6 to 15 */
                background: linear-gradient(to top, #eaeced, #fff); /* Standard syntax */
            }

            .gradientBgReversed{
                background: #fff; /* For browsers that do not support gradients */
                background: -webkit-linear-gradient(top, #fff, #eaeced); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(top, #fff, #eaeced); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(top, #fff, #eaeced); /* For Firefox 3.6 to 15 */
                background: linear-gradient(to top, #fff, #eaeced); /* Standard syntax */
            }
            div{
                color: #333;
            }

            .infoContainer {
                font-size: 0.9em;
                margin: 40px 0px 20px;
                color: #013972;
                background-color: rgba(156, 204, 101, 1);
                padding: 20px;
            }

            .errorContainer {
                font-size: 0.9em;
                margin: 40px 0px 20px;
                color: #9f0000;
                background-color: rgba(255, 154, 102, 1);
                padding: 20px;
            }

            .parallax { 
                /* The image used */
                background-image: url("http://tableenville.com/img/photo_landing%20page_1.jpg");

                /* Set a specific height */
                

                /* Create the parallax scrolling effect */
                background-attachment: fixed;
                background-position: 0px -400px;
                background-repeat: no-repeat;
                background-size: cover;
            }
            
        </style>
    
    <?php 
    if(!isset($_COOKIE["landingPage"])) {
        echo "<body ng-app='TeV' ng-controller='LandingCtrl' layout-align='center center' ng-cloak data-ng-init='sayHiMessage = sayHi; triggerLanding();'>";
    } else {
        echo '<body ng-app="TeV" ng-controller="LandingCtrl" layout-align="center center" ng-cloak>';
    }
    ?>
    <md-content layout="column" class="parallax">
        <div hide-xs layout="row" layout-align="center end" id="header" class="md-padding" style="height: 450px;">
            <img src="http://www.tableenville.com/img/logo_classic_white@2x.png"  alt=""/>
        </div>
        <div hide-gt-xs layout="row" layout-align="center end" id="header" class="md-padding" style="height: 250px;">
            <img src="http://www.tableenville.com/img/logo_classic_white@2x.png"  width="250px" alt=""/>
        </div>
        <div layout="row" layout-align="center center" class="md-padding gradientBg">
            <div flex layout="column" layout-align="center center">
                <div hide-xs layout="row" layout-align="center center" class="md-display-1" style="color: #666; font-style: italic; text-align: right;">
                    <br />"The fondest memories are made around the table."<br />
                    - the TeV team<br/><br/>
                </div>
                <div hide-gt-xs layout="row" layout-align="center center" class="md-title" style="color: #666; font-style: italic; text-align: right;">
                    <br />The fondest memories are made around the table<br />
                    - the TeV team<br/><br/>
                </div>
                <div layout="row"  layout-align="center center">
                    <div style="color: #777; text-align: center;" flex-gt-xs="60" class="md-headline">
                        Table en Ville brings food with a story. We look at the dining table as the original social network to meet new people based on interests and passions.                   
                    </div>
                </div>
                <div layout="row"  layout-align="center center" class="md-padding">
                    <md-button class="md-raised md-warn md-padding" ng-click="sayHiMessage = 'Dine with us'; triggerLanding()" layout="row" layout-align="center center">
                        <span flex></span>
                        <ng-md-icon icon="mail" style="fill: white;"></ng-md-icon>
                        <span class="md-headline" md-colors="{color: 'primary-50'}">&nbsp;Share a table</span>
                        <span flex></span>
                    </md-button>
                    <md-button class="md-raised md-accent" ng-click="triggerLanding()" ng-hide="true">Learn more</md-button>
                </div>
            </div>
        </div>
        <div layout-gt-xs="row" layout-xs="column" class="gradientBgReversed">
            <md-card flex-gt-xs>
                <img ng-src="http://www.tableenville.com/themes/tenv_default/img/cuis3.jpg" class="md-card-image" alt="Social dining">
                <md-card-title>
                    <md-card-title-text>
                        <div layout="row" layout-align="start center">
                            <ng-md-icon icon="restaurant" size="48"  md-colors="{fill: 'primary'}" aria-label="Social dining"></ng-md-icon>
                            <span class="md-display-1">Social dining</span>
                        </div> 
                    </md-card-title-text>
                </md-card-title>
                <md-card-content>
                    <p  class="md-headline">
                        At Table en Ville we believe that the fondest memories are made around the table. We want to bring as many people as possible together at the dining table to enjoy the taste of life. 
                    </p>
                </md-card-content>
            </md-card>
            <md-card flex-gt-xs>
                <img ng-src="http://www.tableenville.com/img/goodfoodgreatpeople.png" class="md-card-image" alt="Social dining">
                <md-card-title>
                    <md-card-title-text>
                        <div layout="row" layout-align="start center">
                            <ng-md-icon icon="local_dining" size="48" aria-label="Good food, great people" md-colors="{fill: 'warn'}"></ng-md-icon>
                            <span class="md-display-1">Good food, great people</span>
                        </div> 
                    </md-card-title-text>
                </md-card-title>
                <md-card-content>
                    <p class="md-headline">
                        Table en Ville brings food with a story. Our online platform connects hosts and guests from diverse backgrounds to share good times. People who love to share their stories of living with others at the dining table.
                    </p>
                </md-card-content>
            </md-card>
            <md-card flex-gt-xs>
                <img ng-src="http://www.tableenville.com/themes/tenv_default/img/cuis6.jpg" class="md-card-image" alt="Social dining">
                <md-card-title>
                    <md-card-title-text>
                        <div layout="row" layout-align="start center">
                            <ng-md-icon icon="group" size="48" md-colors="{fill: 'accent'}" aria-label="The team"></ng-md-icon>
                            <span class="md-display-1">The team</span>
                        </div> 
                    </md-card-title-text>
                </md-card-title>
                <md-card-content layout-align="center center">
                    <p class="md-headline">
                        We are a team of 5 friends (Belgium, Germany, The Netherlands). Passionate about sharing ideas and make things happen. We look at the dining table as the original social network to meet new people based on interests and passions.
                    </p>
                </md-card-content>
            </md-card>
        </div>

        <div layout="column" layout-align="center center" class="gradientBg">

            <br /><br />
            <ng-md-icon icon="restaurant" md-colors="{fill: 'accent'}"></ng-md-icon>
            <h1 style="color: #7c7c7c;" class="md-padding">Join us for our launch event</h1>
            <div layout="row" layout-align="center center">
                <div flex-gt-xs="50"style="color: #7c7c7c; text-align: center;" class="md-padding md-headline">
                        We connect expats living in Brussels to share a meal in great company at the host’s home. People like you who love to share their stories of living and passion for food at the dining table
                </div>
            </div>
            <br />
            <ng-md-icon icon="restaurant" md-colors="{fill: 'warn'}" ng-hide="true"></ng-md-icon><br />
        
            <md-button class="md-raised md-warn md-padding" ng-click="sayHiMessage = 'Join us'; triggerLanding()" layout="row" layout-align="center center">
                <span flex></span>
                <ng-md-icon icon="mail" style="fill: white;"></ng-md-icon>
                <span class="md-headline" md-colors="{color: 'primary-50'}">&nbsp;join us</span>
                <span flex></span>
            </md-button>
            <md-button class="md-raised md-accent" ng-click="triggerLanding()" ng-hide="true">Learn more</md-button>
        
        
        <div layout="row" layout-align="center center">
            <span class="md-primary" style="font-style: italic; text-align: center;color: #7c7c7c;"><br /> * Don't worry, we hate spam too. We won't share your details with anyone.<br><br></span>
        </div>

        <div layout="row" id="footer" hide-xs layout-align="center center"><a href="mailto:contact@tableenville.com" class="mail">&copy; 2017 Table en Ville&nbsp;|&nbsp;all rights reserved&nbsp;|&nbsp;contact@tableenville.com</a>&nbsp;|&nbsp;<i class="fa fa-instagram" aria-hidden="true"></i>&nbsp;<i class="fa fa-facebook" aria-hidden="true"></i>&nbsp;<i class="fa fa-twitter" aria-hidden="true"></i>&nbsp;<br /><br /></div>
        
        <div layout="row" id="footer" hide-gt-xs layout-xs="column" layout-align-xs="center center">
            <span>&copy; 2017 Table en Ville</span>
            <span><a href="mailto:contact@tableenville.com" class="mail">contact@tableenville.com</a></span>
            <span>
                <i class="fa fa-instagram" aria-hidden="true"></i><i class="fa fa-facebook" aria-hidden="true"></i><i class="fa fa-twitter" aria-hidden="true"></i>
            </span>
        </div>
    </div>

    <?php echo '<script type="text/ng-template" id="landing-template.html">' ?>
    <md-dialog aria-label="landing" ng-controller="LandingCtrl" flex="40" flex-xs="85" style="background: url(http://www.tableenville.com/themes/tenv_default/img/cuis5.jpg) no-repeat; background-size:  cover;">
        <form name="LandingForm" id="form" layout="column">
            
            <div layout="row" layout-xs="column" layout-align="center center" class="md-padding"> 
                <div flex-gt-xs="50" layout="column"  md-colors="{fill: 'accent-800'}" layout-align="center start">
                    <h1  md-colors="{color: 'primary'}" class="md-display-3" >{{sayHiMessage}}</h1>
                </div>
                <div flex-gt-xs="50" style="background-color: rgba(255,255,255,0.8); border-radius: 10px;">
                    <div ng-show="mailSent" class='infoContainer'>Details received, thank you!</div>
                    <md-dialog-content>
                        <div class="md-dialog-content" layout="column">
                            <md-input-container class="md-block"  style="line-height:14px; height: 20px;">
                                <label>Email</label>
                                <input name="email" required type="email" ng-model="guest.email" md-autofocus required />
                            </md-input-container>
                            <md-input-container class="md-block" style="line-height:14px; height: 20px;">
                                <label>First name</label>
                                <input type="text" name="nameFirst" ng-model="guest.nameFirst" />
                            </md-input-container>
                            <md-input-container class="md-block" style="line-height:14px; height: 20px;">
                                <label>Last name</label>
                                <input type="text" name="nameLast" ng-model="guest.nameLast" />
                            </md-input-container>
                            <md-input-container class="md-block" style="line-height:14px; height: 20px;">
                                <label>Telephone nr</label>
                                <input name="phone" ng-model="guest.phone" />
                            </md-input-container>
                            <md-input-container class="md-block">
                                <label>Comment / questions</label>
                                <textarea cols="15" rows='3' ng-model="guest.comments" maxlength="250"></textarea>
                            </md-input-container>
                        </div>
                    </md-dialog-content>
                    <md-dialog-actions layout="row">
                        <span flex></span>
                        <md-button layout="row" layout-align="center center" type="submit" ng-click="sendMail(guest);" style="margin-right:20px;" class="md-raised md-warn" ng-disabled="LandingForm.$invalid">
                            <ng-md-icon icon="mail" style="fill:#fff;"></ng-md-icon>
                            <span  md-colors="{color: 'primary-50'}">Send</span>
                        </md-button>
                    </md-dialog-actions>
                </div>
            </div>
        </form>
    </md-dialog>
    <?php echo '</script>' ?>
        </md-content>
</body>

