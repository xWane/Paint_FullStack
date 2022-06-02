<!DOCTYPE html>
<html lang="fr">

	<head>

		<meta charset="utf-8">
		<title>Paint</title>
        <link rel="stylesheet" href="Paint.css"/>

    <!-- JS -->
    <!------------------------ Export PNG----------------------->
    <script src="html2canvas.min.js"></script>
    <script>
        function doCapture() {
            window.scrollTo(0, 0);
// mettre le nom de la section de la toile avec les dessins 
            html2canvas(document.getElementById("paint")).then(function(canvas) {
                console.log(canvas.toDataURL("image/jpeg",0.9));

                var ajax = new XMLHttpRequest();
                ajax.open("POST", "generate-png.php", true);
                ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                ajax.send("image=" + canvas.toDataURL("image/jpeg",0.9));

                ajax.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        window.location.href="upload/paint.png";
                    }
                }
        });
        }
    </script>


	</head>
    <body onload = "move('design')">
<!-- JS -->
        <script>
          

          var dragValue;
          var id_objet;


          function move(that){
              var id_objet = document.getElementById(that.id)
              element = id_objet
              console.log(id_objet)
              element.onmousedown = function(){
                  dragValue = element;
                  
              }

          }



              document.onmouseup = function(e) {
                  dragValue = null;
              }

              document.onmousemove = function(e){
                  var x = e.pageX;
                  var y = e.pageY;

                  dragValue.style.left = x - dragValue.offsetWidth / 2 + 'px';
                  dragValue.style.top = y - dragValue.offsetHeight / 2 + 'px';
              }
        </script>
        <div id="paint">

            <div class="outils">

              <button id="bouton" type="button" >                    
                <div id="design_rectangle" class="design_rectangle" onclick="move(this);"></div>          
              </button>

                
              <button  id="bouton" type="button" >                    
                <div id="design_cercle" class="design_cercle" onclick="move(this);" ></div>          
              </button>
            

              <button  id="bouton" type="button" >                    
                <div id="design_triangle" class="design_triangle" onclick="move(this);" ></div>          
              </button>

              <button  id="bouton" type="button" >                    
                <div id="design_texte"  ></div>          
              </button>

            </div>

            <div id="toile" >   
            </div>
        </div>
        <div id="back">
          <header>
              <h1>OPTIONS DE FICHIERS</h1>
              <!-- Chargement d'un fichier -->
              <div id="charger">
                  <form action="charger.php" method="post" enctype="multipart/form-data">
                  <h4>Charger Fichier</h4>
                  <label for="fileUpload">Fichier:</label>
                  <input type="file" name="file" id="fileUpload">
                  <input type="submit" name="submit" value="Charger">
                  <a href="upload">Voir fichiers chargés</a>
                  </form>
                  
              </div></br>
              <!-- Export PDF -->
              <div id="exportPDF">
                  <a href="generate-pdf.php">Exporter au format PDF</a>
              </div></br>
              <!-- Export PNG -->
              <div id="exportPNG">
                  <button onclick="doCapture();">Exporter au format PNG</button></br>
              </div></br>
              <!-- Sauvegarde -->
              <div id="sauvegarder">
  <!-- Changer path=PAINT.php par le vrai fichier du Paint -->
              <p><a href="sauvegarder.php?path=Paint_div.php">Sauvegarder</a></p>
              </div>
          </header>
          <br>
        </div>


    </body>