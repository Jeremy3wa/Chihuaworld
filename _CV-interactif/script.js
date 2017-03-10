

document.addEventListener("DOMContentLoaded", function()
{
	var app = new PIXI.autoDetectRenderer(1000, 1000, { antialias: true });
	app.stage = new PIXI.Container();
	document.body.appendChild(app.view);

	var circle1 = new PIXI.Graphics();
	var circle2 = new PIXI.Graphics();
	var circle3 = new PIXI.Graphics();
	var circle4 = new PIXI.Graphics();
	var circle5 = new PIXI.Graphics();
	var button = new PIXI.Graphics();
	var arc1 = new PIXI.Graphics();
	var arc2 = new PIXI.Graphics();
	var arc3 = new PIXI.Graphics();
	var arc4 = new PIXI.Graphics();
	var arc5 = new PIXI.Graphics();
	// var repere = new PIXI.Graphics();




	


	// Circle1
	circle1.lineStyle(0);
	circle1.beginFill(0xFFFF0B, 0.6);
	circle1.drawCircle(100, 100,60);
	circle1.endFill();
	circle1.interactive = true;

	
  

 //    arc2.lineStyle(1);
	// arc2.beginFill(0x000000, 1);
 //    arc2.arc(325,100,45,Math.PI,2*Math.PI);
	// arc2.endFill();
	// arc2.visible = false;





	// Circle2
	circle2.lineStyle(0);
	circle2.beginFill(0xFFFF0B, 0.6);
	circle2.drawCircle(100, 150,60);
	circle2.endFill();





	// Circle3
	circle3.lineStyle(0);
	circle3.beginFill(0xFFFF0B, 0.6);
	circle3.drawCircle(100, 200,60);
	circle3.endFill();

	// Circle4
	circle4.lineStyle(0);
	circle4.beginFill(0xFFFF0B, 0.6);
	circle4.drawCircle(100, 250,60);
	circle4.endFill();

// Circle5
	circle5.lineStyle(0);
	circle5.beginFill(0xFFFF0B, 0.6);
	circle5.drawCircle(100, 300,60);
	circle5.endFill();


	app.stage.addChild(circle1);
	app.stage.addChild(circle2);
	app.stage.addChild(circle3);
	app.stage.addChild(circle4);
	app.stage.addChild(circle5);
	app.stage.addChild(button);
	app.stage.addChild(arc1);
	app.stage.addChild(arc2);
	app.stage.addChild(arc3);
	app.stage.addChild(arc4);
	app.stage.addChild(arc5);
	// app.stage.addChild(repere);

	// repere.lineStyle(1, 0x0000FF, 1);
	// repere.beginFill(0xFF700B, 0);
	// repere.drawRect(100, 40, 120, 850);

	button.lineStyle(2, 0x0000FF, 0);
	button.beginFill(0xFF700B, 0);
	button.drawRect(40, 40, 120, 350);
	button.interactive = true;



	//Circle 1
	var bool = false;
	button.on('pointerover', function()
	{
		if (bool == true)
			return;
		bool = true;
		var interv1 = setInterval(function()
		{
			if (circle1.y >= 15)
			{
				

					var style = new PIXI.TextStyle({
				    fontFamily: 'Arial',
				    fontSize: 20,
				    fontWeight: 'bold',
				    fill: ['#ffffff'], 
				    wordWrap: true,
				    wordWrapWidth: 440
				});

				var richText = new PIXI.Text('CSS', style);
				richText.x = 78;
				richText.y = 110;

				app.stage.addChild(richText);


				clearInterval(interv1);
				var degres1 = Math.PI;
				var interv11 = setInterval(function()
				{
					arc1.clear();
					arc1.lineStyle(6, 0x00000);
					degres1 += Math.PI / 64;
			    	arc1.arc(100,115,45,Math.PI,degres1);
			    	if (degres1 > 2*Math.PI)
						clearInterval(interv11);
				}, 10);
			}
			else
			{
				circle1.y += 2;
			}
		}, 0.5);
		circle1.tint = 0xFF0000;
		// circle1.y = 15;

		// arc2.lineStyle(6, 0x00000);
  //   	arc2.arc(100,265,45,Math.PI,2*Math.PI);
		var interv2 = setInterval(function()
		{	

			if (circle2.y >= 115)
			{
				var style = new PIXI.TextStyle({
				    fontFamily: 'Arial',
				    fontSize: 20,
				    fontWeight: 'bold',
				    fill: ['#ffffff'], 
				    wordWrap: true,
				    wordWrapWidth: 440
				});

				var richText = new PIXI.Text('HTML', style);
				richText.x = 74;
				richText.y = 260;

				app.stage.addChild(richText);

				clearInterval(interv2);
				var degres2 = Math.PI;
				var interv12 = setInterval(function()
				{
					arc2.clear();
					arc2.lineStyle(6, 0x00000);
					degres2 += Math.PI / 64;
			    	arc2.arc(100,265,45,Math.PI,degres2);
			    	if (degres2 > 2*Math.PI)
						clearInterval(interv12);
				}, 10);
			}
			else
			{
				circle2.y += 2;
			}
		}, 0.2);
		circle2.tint = 0xFF0000;

		var interv3 = setInterval(function()
		{
			if (circle3.y >= 215)
			{
				var style = new PIXI.TextStyle({
				    fontFamily: 'Arial',
				    fontSize: 20,
				    fontWeight: 'bold',
				    fill: ['#ffffff'], 
				    wordWrap: true,
				    wordWrapWidth: 440
				});

				var richText = new PIXI.Text('PHP', style);
				richText.x = 79;
				richText.y = 405;

				app.stage.addChild(richText);


				clearInterval(interv3);
				var degres3 = Math.PI;
				var interv13 = setInterval(function()
				{
					arc3.clear();
					arc3.lineStyle(6, 0x00000);
					degres3 += Math.PI / 64;
			    	arc3.arc(100,415,45,Math.PI,degres3);
			    	if (degres3 > 1.5*Math.PI)
						clearInterval(interv13);
				}, 10);
			}
			else
			{
				circle3.y += 2;
			}
		}, 0.2);
		circle3.tint = 0xFF0000;

		var interv4 = setInterval(function()
		{
			if (circle4.y >= 315)
			{

				var style = new PIXI.TextStyle({
				    fontFamily: 'Arial',
				    fontSize: 20,
				    fontWeight: 'bold',
				    fill: ['#ffffff'], 
				    wordWrap: true,
				    wordWrapWidth: 440
				});

				var richText = new PIXI.Text('mySQL', style);
				richText.x = 64;
				richText.y = 555;

				app.stage.addChild(richText);

				clearInterval(interv4);
				var degres4 = Math.PI;
				var interv14 = setInterval(function()
				{
					arc4.clear();
					arc4.lineStyle(6, 0x00000);
					degres4 += Math.PI / 64;
			    	arc4.arc(100,565,45,Math.PI,degres4);
			    	if (degres4 > 2.5*Math.PI)
						clearInterval(interv14);
				}, 10);

			}
			else
			{
				circle4.y += 2;
			}
		}, 0.2);
		circle4.tint = 0xFF0000;

		var interv5 = setInterval(function()
		{
			if (circle5.y >= 415)
			{

				var style = new PIXI.TextStyle({
				    fontFamily: 'Arial',
				    fontSize: 20,
				    fontWeight: 'bold',
				    fill: ['#ffffff'], 
				    wordWrap: true,
				    wordWrapWidth: 440
				});

				var richText = new PIXI.Text('JS', style);
				richText.x = 88;
				richText.y = 705;

				app.stage.addChild(richText);

				clearInterval(interv5);
				var degres5 = Math.PI;
				var interv15 = setInterval(function()
				{
					arc5.clear();
					arc5.lineStyle(6, 0x00000);
					degres5 += Math.PI / 64;
			    	arc5.arc(100,715,45,Math.PI,degres5);
			    	if (degres5 > 2*Math.PI)
						clearInterval(interv15);
				}, 10);
			}
			else
			{
				circle5.y += 2;
			}
		}, 0.2);
		circle5.tint = 0xFF0000;
	});
	// button.on('pointerout', function()
	// {
	// 	circle1.tint = 0xFFFFFF;
	// 	circle1.y = 0;
	// });

	function refresh()
	{
		app.render(app.stage);
		requestAnimationFrame(refresh);
	}
	refresh();
	
});






