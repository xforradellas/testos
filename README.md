# ProManresa

<h2>Contingut</h2>

<h3>Web</h3>
    <p>Api publica i privada en php</p>
    <p>El codi font esta a:  <code>/images/web</code></p>
<h2>Passos per clonar el repositori</h2>
<ol>
<li>Clonar el repositori</li>
<li>Afegir al directori arrel el fitxer .env amb la variable "githubtoken: [token vàlid]"</li>
<li>executar <code>make start-devel</code></li>
<li>Si estem en linux afegir permisos 777 a la carpeta i subcarpeta <code>images/web/src/cache</code></li>
</ol>
<h2>Entorn de proves</h2>
<p>
    L'entorn de proves fa servir una imatge amb el contingut local de la maquina per poder desenvolupar i anar veien els resultats dels canvis sense necesitat de crear una nova imatge.
</p>

<h3> Contingut </h3>

<ul>
    <li><b>Web (PHP):</b> Web que fa servir les apis públiques</li>
    <li><b>Redis:</b> Base de dades redis que es fa servir per la cache</li>
</ul>


<h3> Iniciar entorn de proves</h3>
<ol>
<li> Iniciem tot l'entorn: <br/> <code>make start-devel</code></li>
<li>Si és la primera vegada executar per instalar llibreries necesaries:<br/> <code>make init-devel</code></li>
</ol>



<h3>Accedir al entorn de proves</h3>
<ul>
    <li>Accedir a web: <code>http://localhost:88/conservatori/</code></li>
</ul>

<h3>Aturar entorn de proves</h3>
<p>Amb aquesta comanda pararem tot l'entorn de proves</p>
<p><code>make stop-devel</code></p>

<h2>Dependencies</h2>
<ul>
    <li>Serveis
        <ul>
            <li>Redis</li>
            <li>Api media</li>
            <li>Api webs</li>
            <li>Api agenda</li>
            <li>Api noticies</li>
        </ul>
    </li>
    <li>Configmap
        <ul>
            <li>Entorn</li>
        </ul>
    </li>
</ul>

<h2>Kubernetes</h2>


<h3>Pujar-ho a kubernetes manualment</h3>
<ul>
    <li>crear les imatges: <br/><code>make create-image</code></li>
    <li>pujar imatge al registry: 
        <br/><code>make upload-image</code></li>
    </li>
    <li>crear l'entorn a kubernetes:
        <ul>
            <li>entorn stage: <code>kubectl apply -f k8s/stage</code></li></li>
            <li>entorn prod: <code>kubectl apply -f k8s/prod</code></li></li>
        </ul>
    </li>
</ul>
<h3>Aturar entorn kubrnetes</h3>
<ul>
    <li>entorn stage: <code>kubectl delete -f k8s/stage</code></li></li>
    <li>entorn prod: <code>kubectl delete -f k8s/prod</code></li></li>
</ul>



