//  This example was created by Jens Anders Bakke

var game = new Phaser.Game(1920, 1080, Phaser.AUTO, 'phaser-example',{ preload: preload, create: create },true);

function preload() {

    /*game.load.image('sky', 'assets/skies/sky3.png');*/
    game.load.spritesheet('snowflakes', 'assets/sprites/snowflakes.png', 17, 17);
    game.load.spritesheet('snowflakes_large', 'assets/sprites/snowflakes_large.png', 64, 64);

}

var max = 0;
var front_emitter;
var mid_emitter;
var back_emitter;
var update_interval = 4 * 60;
var i = 0;
var amountOfFlakes= 200;
var flakes;
var array = [];
function create() {
    flakes = game.add.group();

    for(var a=0; i<amountOfFlakes; i++){
    var randomX = Math.floor(Math.random() * 1920);
    var randomY = Math.floor(Math.random() * 1200);
    var randomSnowflake= ['snowflakes_large','snowflakes'];
    var randomSprite = Math.floor(Math.random() * 5);
    var randomFlake = Math.floor(Math.random() * 2);
    var flake = game.add.sprite(randomX, randomY, randomSnowflake[randomFlake],randomSprite);
        flakes.add(flake);
        array.push(flake);
        game.physics.arcade.enable(flake);
        flake.enableBody = true;
        flake.body.gravity.y = 0;
        flake.body.collideWorldBounds = false;
        flake.scale.setTo(10, 10);
    }
    var testint = 50;
    var bool = true;
    var gameworldy = game.world.y - 200;

   function lilyPadOOB(flake) {   console.log("bounce!") }
    setInterval(function(){
        flakes.forEach(function(flake){
            if(flake.y < gameworldy){
                console.log('BOEM');
                flake.destroy();
            }else{
                if(globalAvarage < 90){

                    if(bool){
                        testint = testint + testint;
                        bool = false
                    }
                    flake.body.gravity.y = 0;
                    /*     flakes.setAll('body.mass', 99);
                     flakes.setAll('body.friction', 99);*/

                }else{
                    bool=true;
                    /*flake.body.gravity.y = -globalAvarage * Math.random()*1000;*/
                    /*var randomGrav = -globalAvarage  * Math.random() * 5;*/
                    flake.body.gravity.y =   -globalAvarage  * Math.random() * 5;
                    /*flake.body.mass = 0;*/
                   /* setTimeout(function(){
                       flake.body.gravity.y = -randomGrav;
                    },200);*/

                }
            }


        });
    }, 200);

}
function update() {


}

