# horses
A plugin for an equine website on a WordPress.
Makes a list of horses - like woocommerce but not as heavy and it is more catalogue then a web shop
Though, you can sell horses there and you can receive notification when someone wants to buy a horse from you
You can store an information about your horses there and sort by 
  - breed
  - birthyear
  - parents
  - taking parts in races 
  - awards
  - and many many more

It was written for a website https://1k-horse.com/ so you can see how it works there.

Right now it is in Russian. If you want me to do the localisation - write me sagittarius.group@gmail.com

<h2>How to use it</h2>
1. Download horses.zip and install it as a plugin on your Wordpress website<br>
2. Activate plugin<br>
3. You will see a new item in left menu in Admin mode of your site named "Horses". Act with it like with any other post types in Wordpress: create, edit and delete<br>
4. You will need to create names of breeds and races before you can choose them in a horese description <br>
5. You can pick up horse ancestors or children if they are already exist... or you can just write their names without creating a new item<br>

<h2>Templates</h2>
I have made some templates for my WP Theme Equine by Mikado Themes<br>
Here's some templates for that WP Theme... maybe you will need another design <br>
<b>single-horse.php</b> - for the page of a horse<br>
<b>taxonomy-horse_tax.php</b> - to list different types of horses: stallions, mares, geldings, horses for sale, horses for racing and so on (all that horses you create in Horses plugin menu)<br>
<b>taxonomy-horse_breed.php</b> - to list one breed (that you create in Horses plugin menu)<br>
<b>taxonomy-horse_race.php</b> - to list horses who took part in specified race with the place they had (races you create in Horses plugin menu, the place you choose while editing horse)

<h2>Shortcode</h2>
I use shortcode for templates for listing horses.<br>
Here is it.<br><br>
<pre>
[<b>showhorses id</b>='0/num of the horse' <i>num - I mean, when you edit a horse, https://site.com/wp-admin/post.php?post=<b>num of the horse</b>&action=edit</i> Default: 0<br>
           <b> cat</b>='num of category' - to list horses only from specified category, only stallions for example. Shows all categories if not specified. Default: 0<br>
           <b> num</b>='how much to show' - to show all if not specified. Default: -1 <br>
           <b> perrow</b>='12/Num of cols' - I mean, if you need 3 per row write here "4" and it will have col-md-4 in classes. Default: 4<br>
           <b> showyear</b>='yes/no' - show the birthyear or not. Default: yes<br>
           <b> year</b>='0 or year' - show horses only of specififed year or from all years if 0. Default:0<br>
           <b> form</b>='square/circle/rect' - the way of formatting the portrait of horse. Default: square<br>
           <b> breed</b>='yes/no' - show the name of a breed or not. Default: no<br>
           <b> price</b>='yes/no' - show the price or not. Deafault: no<br>
           <b> forsale</b>='yes/no' show only horses for sale orn not. Default: 'no'<br>
           <b> breednum</b>='0 or breed num' shows horses only from specified category if specified. Default: 0 <br>
           <b> othertext</b>='If there any other text, that should be written in a horse card write it here']<br>
           </pre>
