function addChild()
{
	var children_num=document.getElementById('all_children_num');
	var all_children_num=Number.parseInt(children_num.value);
	var prevnum=all_children_num-1;
	children_num.value=all_children_num+1;
	console.log(all_children_num);
	div2 = document.getElementById('div_horse_child_'+prevnum).cloneNode(true);
	div2.id='div_horse_child_'+all_children_num;
	console.log(div2);
	div2.querySelector('#horse_child_'+prevnum).name='horse_child_'+all_children_num;
	div2.querySelector('#horse_child_'+prevnum).id='horse_child_'+all_children_num;
	
	console.log(div2);
	document.getElementById('div_horse_child_'+prevnum).after(div2);
	
}

function addOtherChild()
{
	var children_num=document.getElementById('all_other_children_num');
	var all_children_num=Number.parseInt(children_num.value);
	children_num.value=all_children_num+1;
	var div=document.createElement('div');
	div.className='row';
	div.innerHTML='<div class="col-md-4 name">Имя потомка: </div><div class="col-md-6"> <input type="text" name="horse_other_child_'+all_children_num+'" value=""/></span></div>';
	document.getElementById('add_new_other_child').after(div);
}

function addRace()

{	var num=document.getElementById('all_horse_races');
	var races_num=Number.parseInt(num.value);
	var prevnum=races_num-1;
	num.value=races_num+1;
	console.log(races_num);
	div2 = document.getElementById('div_horse_race_'+prevnum).cloneNode(true);
	div2.id='div_horse_race_'+races_num;
	console.log(div2);
	div2.querySelector('#horse_race_'+prevnum).name='horse_race_'+races_num;
	div2.querySelector('#horse_race_'+prevnum).id='horse_race_'+races_num;
    div2.querySelector('#horse_place_'+prevnum).name='horse_place_'+races_num;
	div2.querySelector('#horse_place_'+prevnum).id='horse_place_'+races_num;
    div2.querySelector('#delete_button_'+prevnum).setAttribute('onclick', 'JavaScript: deleteRace('+races_num+')');
    div2.querySelector('#delete_button_'+prevnum).id='delete_button_'+races_num;
	console.log(div2);
	document.getElementById('div_horse_race_'+prevnum).after(div2);
	
}

function deleteOtherChild(id)
{
	// Удаляем узел с номером id
	var node=document.querySelector('#div_horse_other_child_'+id);
	
	node.parentNode.removeChild(node);
	
	// Находим значение кол-во всех детей и уменьшаем его на один
	var children_num=document.getElementById('all_other_children_num');
	var all_children_num=Number.parseInt(children_num.value);
	children_num.value=all_children_num-1;
	
	// Находим все элементы <input>, которые мы пометили классом horse_other_child и выдаём им номера по очереди
	var el=document.querySelectorAll('.horse_other_child');
	for (var i=0; i<el.length; i++ )
		{el[i].name='horse_other_child_'+i;}
	
}

function deleteChild(id)
{    // Находим значение кол-во всех детей и уменьшаем его на один
	var children_num=document.getElementById('all_children_num');
	var all_children_num=Number.parseInt(children_num.value);
	 
	console.log(all_children_num);
	if (all_children_num>1)
		{
	children_num.value=all_children_num-1;
	// Удаляем узел с номером id
	var node=document.querySelector('#div_horse_child_'+id);
	
	node.parentNode.removeChild(node);
	
	// Находим все элементы <input>, которые мы пометили классом horse_other_child и выдаём им номера по очереди
	var el=document.querySelectorAll('.horse_child');
	for (var i=0; i<el.length; i++ )
		{el[i].name='horse_child_'+i;}
		}
	else 
		{
		 children_num.value=0;	
		 var lastopt=document.getElementById('no_children');
		 lastopt.value=0;
		 lastopt.innerHTML='Выберите потомка из списка';	
		 var div=document.createElement('div');
	     div.className='row';
		 div.innerHTML='<h4>Все потомки удалены.</h4>';
		 document.getElementById('div_horse_child_0').after(div);}
}
function deleteRace(id)
{
	
	// Находим значение кол-во всех соревнований
	
	var num=document.getElementById('all_horse_races');
	var races_num=Number.parseInt(num.value);
	if (races_num>1)
		{  // Если оно больше 1 - уменьшаем на 1
	       num.value=races_num-1;	
 	
           // Удаляем узел с номером id
	       var node=document.querySelector('#div_horse_race_'+id);	
	       node.parentNode.removeChild(node);
	
	       // Находим все элементы <input>, которые мы пометили классом horse_race и выдаём им номера по очереди
	       var el=document.querySelectorAll('.horse_race');
	       for (var i=0; i<el.length; i++ )
		    {el[i].name='horse_race_'+i;}
		   el=document.querySelectorAll('.horse_place');
	       for (var i=0; i<el.length; i++ )
		    {el[i].name='horse_place_'+i;}
				
		}
	else
		{
		   num.value=0;
		   var node=document.querySelector('#first_value_0');
		   node.value=0;
		   node.value.innerHTML='Все участия удалены.';	
		   document.querySelector('#horse_place_0').value='';	
		}
	
}