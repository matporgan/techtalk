<div id="thecube">
    <div class="scene">
        <div class="shape cuboid-1 cub-1">
            <a id="industry" class="modal-trigger" href="#cube-industries"><div class="face ft">
               <div class="face-content">Industries</div>
            </div></a>
            <a id="domain" class="modal-trigger" href="#cube-domains"><div class="face lt">
                <div class="face-content">Domains</div>
            </div></a>
            <a id="technology" class="modal-trigger" href="#cube-technologies"><div class="face tp">
                <div class="face-content">Technologies</div>
            </div></a>
            <div class="face shadow"></div>
            <div class="face shadow2"></div>
            <div class="face shadow3"></div>
            <div class="face shadow4"></div>
        </div>
    </div>
</div>

<style type="text/css">

#thecube-wrapper img {
  position: absolute;
  top: 144px;
  left: 50%;
  margin-left: -152px;
  width: 414px;
  z-index: -1;
}

#thecube {
  perspective: 800px;
  position: relative;
  overflow: inherit;
  width: 100%;
  height: 100%;
  background: transparent;
  font-size: 100%;

}
.face {
  box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.4);
}
.scene, .shape, .face, .face-wrapper, .cr {
  position: absolute;
  transform-style: preserve-3d;
}
.scene {
  width: 80em;
  height: 80em;
  top: 50%;
  left: 50%;
  margin: -41em 0 0 -40em;
  -webkit-transform:rotateX(-35deg) rotateY(-45deg); 
  -moz-transform:rotateX(-35deg) rotateY(-45deg); 
  -ms-transform:rotateX(-35deg) rotateY(-45deg); 
  transform:rotateX(-35deg) rotateY(-45deg);
}
.shape {
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  transform-origin: 50%;
}
.lt:hover, .ft:hover, .tp:hover {
    background: #00ade3 !important;
    color: #fff;
}
.face, .face-wrapper {
  overflow: hidden;
  transform-origin: 0 0;
  backface-visibility: hidden;
  /* hidden by default, prevent blinking and other weird rendering glitchs */
}
.face {
  background-size: 100% 100%!important;
  background-position: center;
}
.face-wrapper .face {
  left: 100%;
  width: 100%;
  height: 100%
}
.face-content {
    position: relative;
    top: 38%;
    text-align: center;
    font-size: 30px;
}
#technology .face-content {
    -webkit-transform: rotateZ(-45deg);
    -moz-transform: rotateZ(-45deg);
    -ms-transform: rotateZ(-45deg);
    transform: rotateZ(-45deg);
}
.photon-shader {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%
}
.side {
  left: 50%;
}
.cr, .cr .side {
  height: 100%;
}
[class*="cuboid"] .ft, [class*="cuboid"] .bk {
  width: 100%;
  height: 100%;
}
[class*="cuboid"] .bk {
  left: 100%;
}
[class*="cuboid"] .rt {
  transform: rotateY(-90deg) translateX(-50%);
}
[class*="cuboid"] .lt {
  transform: rotateY(90deg) translateX(-50%);
}
[class*="cuboid"] .tp {
  transform: rotateX(90deg) translateY(-50%);
}
[class*="cuboid"] .bm {
  transform: rotateX(-90deg) translateY(-50%);
}
[class*="cuboid"] .shadow {
  transform: rotateX(-270deg) rotateZ(12deg) translateY(-107%) translateX(-14%) skewX(5deg);
}
[class*="cuboid"] .shadow2 {
  transform: rotateX(-270deg) translateY(-50%);
}
[class*="cuboid"] .shadow3 {
  transform: translateZ(7.45em);
}
[class*="cuboid"] .shadow4 {
  transform: translateZ(7.55em) translateX(15em) rotateY(90deg);
}
[class*="cuboid"] .lt {
  left: 100%;
}
[class*="cuboid"] .bm {
  top: 100%;
}
[class*="cuboid"] .shadow {
  top: 100%;
}
[class*="cuboid"] .shadow2 {
  top: 100%;
}
[class*="cuboid"] .shadow3 {
  top: 100%;
}
[class*="cuboid"] .shadow4 {
  top: 100%;
}
/* .cub-1 styles */
.cub-1 {
  transform:translate3D(0em, 0em, 0em) rotateX(0deg) rotateY(0deg) rotateZ(0deg);
  opacity:1;
  width:15em;
  height:15em;
  margin:-7.5em 0 0 -7.5em;
}
.cub-1 .ft {
  transform:translateZ(7.5em);
}
.cub-1 .bk {
  transform:translateZ(-7.5em) rotateY(180deg);
}
.cub-1 .rt, .cub-1 .lt {
  width:15em;
  height:15em;
}
.cub-1 .tp, .cub-1 .bm {
  width:15em;
  height:15em;
}
.shadow {
    height:10em;
    width: 15em;
    box-shadow: 44px -74px 163px #333;
}
.shadow2 {
    height:15em;
    width: 15em;
    box-shadow: 0 0 150px #111;
}
.shadow3, .shadow4 {
    height:15em;
    width: 15em;
    box-shadow: none;
    background: linear-gradient(to top, rgba(0,0,0,0), #ddd);
}
.cub-1 .face {
  background-color:#FFFFFF;
}

.cub-1 .tp {
    background: #eee;
}
.cub-1 .tp:hover {
    background: #00ade3 !important;
    color: #fff;
}

.cub-1 .lt {
    background: #ddd;
}
.cub-1 .lt:hover {
    background: #00ade3 !important;
    color: #fff;
}

.cub-1 .ft {
  width:15em;
  margin-left:0em;
}
.cub-1 .bk {
  width:15em;
  margin-left:0em;
}
.cub-1 .rt, .cub-1 .lt {
  width:15em;
}
.cub-1 .tp, .cub-1 .bm, .cub-1 .tp .photon-shader, .cub-1 .bm .photon-shader {
  border-radius:0em;
}
.cub-1 .cr {
  width:0em;
  left:0em;
}
.cub-1 .cr-0 {
  transform: translate3D(15em, 0, 7.5em);
}
.cub-1 .cr-1 {
  transform: translate3D(15em, 0, -7.5em);
}
.cub-1 .cr-2 {
  transform: translate3D(0, 0, -7.5em);
}
.cub-1 .cr-3 {
  transform: translate3D(0, 0, 7.5em);
}
.cub-1 .cr-0 .s0 {
  transform: rotateY(15deg) translate3D(-50%, 0, -0.025em);
}
.cub-1 .cr-0 .s1 {
  transform: rotateY(45deg) translate3D(-50%, 0, -0.025em);
}
.cub-1 .cr-0 .s2 {
  transform: rotateY(75deg) translate3D(-50%, 0, -0.025em);
}
.cub-1 .cr-1 .s0 {
  transform: rotateY(105deg) translate3D(-50%, 0, -0.025em);
}
.cub-1 .cr-1 .s1 {
  transform: rotateY(135deg) translate3D(-50%, 0, -0.025em);
}
.cub-1 .cr-1 .s2 {
  transform: rotateY(165deg) translate3D(-50%, 0, -0.025em);
}
.cub-1 .cr-2 .s0 {
  transform: rotateY(195deg) translate3D(-50%, 0, -0.025em);
}
.cub-1 .cr-2 .s1 {
  transform: rotateY(225deg) translate3D(-50%, 0, -0.025em);
}
.cub-1 .cr-2 .s2 {
  transform: rotateY(255deg) translate3D(-50%, 0, -0.025em);
}
.cub-1 .cr-3 .s0 {
  transform: rotateY(285deg) translate3D(-50%, 0, -0.025em);
}
.cub-1 .cr-3 .s1 {
  transform: rotateY(315deg) translate3D(-50%, 0, -0.025em);
}
.cub-1 .cr-3 .s2 {
  transform: rotateY(345deg) translate3D(-50%, 0, -0.025em);
}
.cub-1 .side {
  width:0.025em;
}
</style>