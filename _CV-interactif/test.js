

var x = 0;
var context;
document.addEventListener("DOMContentLoaded", function()
{
	var canvas = document.querySelector('#cv');
	var ctx = canvas.getContext('2d');
	ctx.lineWidth = 10;



var transparent = new PIXI.Graphics();
			transparent.interactive = true;
			// transparent.on('pointerover', function()
			// {
			// 	this.tint = 0xEEEEEE;
			// });
			// transparent.on('pointerout', function()
			// {
			// 	this.tint = 0xFFFFFF;
			// });
			transparent.lineStyle(1, 0x666666, 1);
			transparent.beginFill(0xFFFFFF);
			transparent.drawRect(0, 0, size, size);
			transparent.endFill();
			transparent.x = x * size + 1;
			transparent.y = y * size;
			stage.addChild(transparent);
			y++;

// // BUTTON

	ctx.fillStyle = "rgba(0, 0, 0, 0)";
	ctx.fillRect(10, 10, 200, 400);



// // Cercle HTML
	ctx.beginPath();
	ctx.arc(100,100, 50,0,Math.PI*2,true);
	ctx.strokeStyle = "pink";
	ctx.stroke();

	ctx.beginPath();
	ctx.arc(100,100, 50,4.7,Math.PI*0.2,true);
	ctx.strokeStyle = "black";
	ctx.stroke();

// // Cercle CSS
	ctx.beginPath();
	ctx.arc(100,150, 50,0,Math.PI*2,true);
	ctx.strokeStyle = "pink";
	ctx.stroke();

	ctx.beginPath();
	ctx.arc(100,150, 50,4.7,Math.PI*0.2,true);
	ctx.strokeStyle = "black";
	ctx.stroke();

// // Cercle JS
	ctx.beginPath();
	ctx.arc(100,200, 50,0,Math.PI*2,true);
	ctx.strokeStyle = "pink";
	ctx.stroke();

	ctx.beginPath();
	ctx.arc(100,200, 50,4.7,Math.PI*0.2,true);
	ctx.strokeStyle = "black";
	ctx.stroke();

// // Cercle PHP
	ctx.beginPath();
	ctx.arc(100,250, 50,0,Math.PI*2,true);
	ctx.strokeStyle = "pink";
	ctx.stroke();

	ctx.beginPath();
	ctx.arc(100,250, 50,4.7,Math.PI*0.2,true);
	ctx.strokeStyle = "black";
	ctx.stroke();

// // Cercle MySQL

	ctx.beginPath();
	ctx.arc(100,300, 50,0,Math.PI*2,true);
	ctx.strokeStyle = "pink";
	ctx.stroke();

	ctx.beginPath();
	ctx.arc(100,300, 50,4.7,Math.PI*0.2,true);
	ctx.strokeStyle = "black";
	ctx.stroke();


	function explode()
	{

	}

	function infos()
	{

	}
	

});









