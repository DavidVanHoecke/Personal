<html lang="en" >
    <head>

        <Title>Set the world on fire!</title>
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
            var app = angular.module('AmokApp', ['ngMaterial', 'ngMdIcons']);
            app.controller('ThermoCtrl', ['$scope', '$mdDialog', '$mdMedia', '$mdToast', function ($scope, $mdDialog, $mdMedia, $mdToast) {
                    $scope.selectedTimeBlocksArray = [];
                    $scope.fallbackTemp = 23;
                    $scope.temp = 19;
                    $scope.desiredTemp = $scope.fallbackTemp;
                    $scope.humidity = 30;
                    $scope.savedDesiredTemp = $scope.fallbackTemp;
                    $scope.status = "defrost";
                    $scope.uptime = "85 days";
                    $scope.lastUpdate = "1 min ago";
                    $scope.heatinOnAt = "18";
                    $scope.heatinOffAt = "23";
                    
                    $scope.toggleTimeBlock = function(n){
                        if($scope.selectedTimeBlocksArray.indexOf(n) == -1){
                            $scope.selectedTimeBlocksArray.push(n);
                        } else {
                            
                            var index = $scope.selectedTimeBlocksArray.indexOf(n);
                            $scope.selectedTimeBlocksArray.splice(index, 1);
                            
                        }
                    }       
                                        
                    $scope.changeTemp = function(inc){
                        if(inc){
                            $scope.desiredTemp++;
                        } else {
                            $scope.desiredTemp--;
                        }
                        
                        $scope.savedDesiredTemp = $scope.desiredTemp;
                        
                        $scope.setTemp();
                    }
                    
                    $scope.heatingOn = true;
                    
                    $scope.toggleHeating = function(){
                        $scope.heatingOn = !$scope.heatingOn;
                        
                        $scope.desiredTemp = 15;
                        $scope.status = "defrost";
                        if($scope.heatingOn == true){
                            $scope.desiredTemp = $scope.savedDesiredTemp;
                            $scope.status = "heating";
                        }
                        
                        $scope.setTemp();
                    }
                    
                    $scope.setTemp = function(){
                        showToast("Heating changed to: " + $scope.desiredTemp + "°", $mdToast);
                    }
                }]);
            
                


            app.config(function ($mdThemingProvider) {
                $mdThemingProvider.theme('default')
                        .primaryPalette('brown')
                        .accentPalette('orange')
                        .warnPalette('deep-orange');

                // This is the absolutely vital part, without this, changes will not cascade down through the DOM.
                $mdThemingProvider.alwaysWatchTheme(true);
            })
            
            function showToast(content, $mdToast) {
                $mdToast.show($mdToast.simple().textContent(content).parent(document.querySelectorAll('#tab1-content')).position('top left'));
            }

            function sleep(time) {
                return new Promise((resolve) => setTimeout(resolve, time));
            }

        </script>

        <style>
            body, md-content, p{
                color: #7c7c7c;
            }

            .md-headline{
                color: #7c7c7c;
            }
         
            .gradBg{
                background: linear-gradient(#ccc, #666, #ccc);
            }
            
            .test{
                background: green;
            }
            
            .padLeft{
                padding-left: 50px;
            }
            
            .noPadding
            {
                padding: 0px;
            }
            
            .timeBlock{
                width: 50px;
                height: 15px;
                background: #ddd;
                border-radius: 3px;
                margin: 2px;
            }
            
            .selectedTimeBlock{
                
                background: orange;
                
            }
        </style>
    </head>
    <body ng-cloak ng-app="AmokApp" ng-controller="ThermoCtrl">
        <!--
        <div layout="row">
            <div ng-repeat="c in selectedTimeBlocksArray">
                {{c}}
            </div>
        </div>
        -->
        <md-content layout="column" class="gradBg" hide-xs>
            <div flex="10"></div>
            <div flex="80" layout="row" hide-xs>
                <div flex></div>
                <div layout="column" layout-align="center stretch" style="width:800px;">
                    <div layout="row">
                        <div flex  layout="column" layout-align="center center" ng-init="selection = { selectedNode:  null }">
                            <div class="md-whiteframe-2dp timeBlock md-caption" layout="column" ng-click="toggleTimeBlock(n)" ng-class="{selectedTimeBlock : selectedTimeBlocksArray.indexOf(n) !== -1}" layout-align="center center" ng-repeat="n in [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23]">
                                <div >
                                    {{n}}:00
                                </div>
                            </div>
                        </div>
                        <div flex="60" layout="column" layout-align="center center" class="noPadding">
                            <ng-md-icon icon="whatshot" size="450" md-colors="{fill: 'warn'}" aria-label="Heating" ng-show="heatingOn" ng-click="toggleHeating();"></ng-md-icon>
                            <ng-md-icon icon="ac_unit" size="450" md-colors="{fill: 'cyan-700'}" aria-label="Defrost" ng-hide="heatingOn" ng-click="toggleHeating();"></ng-md-icon>
                        </div>
                        <div layout="column" layout-align="center center">
                            <div flex><ng-md-icon icon="expand_less" size="174" md-colors="{fill: 'accent-700'}" aria-label="up" ng-click="changeTemp(true)"></ng-md-icon></div>
                            <div flex><ng-md-icon icon="expand_more" size="174" md-colors="{fill: 'accent-700'}" aria-label="down" ng-click="changeTemp(false)"></ng-md-icon></div>
                        </div>
                    </div>
                    <div layout="row" layout-align="center center">
                        
                            <div flex="10"></div>
                            <div layout="column" layout-align="center center" flex>
                                <span class="md-accent">Humidity</span>
                                <span class="md-display-2 padLeft" md-colors="{color: 'Indigo'}">{{humidity}}%</span>
                            </div>
                            <div layout="column" layout-align="center center" flex>
                                <span class="md-accent">Current temp</span>
                                <span class="md-display-2 padLeft" md-colors="{color: 'accent-700'}">{{temp}}°</span>
                            </div>                        
                            <div layout="column" layout-align="center center" flex>
                                <span class="md-accent">Desired temp</span>
                                <span class="md-display-2 padLeft" md-colors="{color: 'warn'}">{{desiredTemp}}°</span>
                            </div>
                            <div flex="10"></div>
                        
                    </div>
                    <md-card md-theme="{{ showDarkTheme ? 'dark-grey' : 'default' }}" md-theme-watch>
                        <md-card-title>
                            <md-card-title-media>
                                <ng-md-icon icon="assessment" size="72" md-colors="{fill: 'warn'}" aria-label="Stats"></ng-md-icon>
                            </md-card-title-media>
                            <md-card-title-text>
                                <span class="md-headline">Status: {{status}}</span>
                                <span class="md-subhead">uptime: {{uptime}} | last update: {{lastUpdate}} | heating on: {{heatinOnAt}}:00 | heating off : {{heatinOffAt}}:00</span>
                            </md-card-title-text>
                        </md-card-title>
                    </md-card>
                </div>
                <div flex></div>
            </div>
            <div flex="10"></div>
        </md-content>
        <md-content layout="column" class="gradBg" hide-gt-xs>
            <!-- SHOW ON MOBILE -->
            <div flex layout="row" hide-gt-xs>
                <div  layout="column" layout-align="center stretch">
                    
                    <div   layout="column" layout-align="center center">
                        <div ><ng-md-icon icon="expand_less" size="96" md-colors="{fill: 'accent-700'}" aria-label="up" ng-click="changeTemp(true)"></ng-md-icon></div>
                        <ng-md-icon icon="whatshot" size="175" md-colors="{fill: 'warn'}" aria-label="Heating" ng-show="heatingOn" ng-click="toggleHeating();"></ng-md-icon>
                        <ng-md-icon  icon="ac_unit" size="175" md-colors="{fill: 'cyan-700'}" aria-label="Defrost" ng-hide="heatingOn" ng-click="toggleHeating();"></ng-md-icon>
                        <div ><ng-md-icon icon="expand_more" size="96" md-colors="{fill: 'accent-700'}" aria-label="down" ng-click="changeTemp(false)"></ng-md-icon></div>
                    </div>
                       
                    <div layout="row" layout-align="center center">
                        
                        <div flex="10"></div>
                        <div layout="column" layout-align="center center" flex>
                            <span class="md-accent">Humidity</span>
                            <span class="md-display-1" md-colors="{color: 'Indigo-300'}">{{humidity}}%</span>
                        </div>
                        <div layout="column" layout-align="center center" flex>
                            <span class="md-accent">Current temp</span>
                            <span class="md-display-1" md-colors="{color: 'accent-700'}">{{temp}}°</span>
                        </div>                        
                        <div layout="column" layout-align="center center" flex>
                            <span>Desired temp</span>
                            <span class="md-display-1" md-colors="{color: 'warn'}">{{desiredTemp}}°</span>
                        </div>
                        <div flex="10"></div>
                        
                    </div>
                    <md-card md-theme="{{ showDarkTheme ? 'dark-grey' : 'default' }}" md-theme-watch>
                        <md-card-title layout="row" layout-align="center center">
                            <md-card-title-media>
                                <ng-md-icon icon="assessment" size="72" md-colors="{fill: 'warn'}" aria-label="Stats"></ng-md-icon>
                            </md-card-title-media>
                            <md-card-title-text>
                                <span class="md-headline">Status: {{status}}</span>
                                <span class="md-subhead">uptime: {{uptime}} | last update: {{lastUpdate}} | heating on: {{heatinOnAt}}:00 | heating off : {{heatinOffAt}}:00</span>
                            </md-card-title-text>
                        </md-card-title>
                    </md-card>
                    <div layout="row" layout-align="center center">
                        <div layout="column" layout-align="center center" ng-init="selection = { selectedNode:  null }">
                            <div class="md-whiteframe-2dp timeBlock md-caption" layout="column" ng-click="toggleTimeBlock(n)" ng-class="{selectedTimeBlock : selectedTimeBlocksArray.indexOf(n) !== -1}" layout-align="center center" ng-repeat="n in [0,1,2,3,4,5,6,7,8,9,10,11]">
                                <div >
                                    {{n}}:00
                                </div>
                            </div>
                        </div>
                        <div layout="column" layout-align="center center" ng-init="selection = { selectedNode:  null }">
                            <div class="md-whiteframe-2dp timeBlock md-caption" layout="column" ng-click="toggleTimeBlock(n)" ng-class="{selectedTimeBlock : selectedTimeBlocksArray.indexOf(n) !== -1}" layout-align="center center" ng-repeat="n in [12,13,14,15,16,17,18,19,20,21,22,23]">
                                <div >
                                    {{n}}:00
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div flex></div>
                
            </div>
        </md-content>
    </body>
</html>