<?
/* @var $this yii\web\View */
use yii\helpers\Html;
use app\components\mgcms\MgHelpers;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;
use yii\helpers\Url;
use app\models\mgcms\db\Menu;
use app\widgets\OeiizkMenu;

$menu = new OeiizkMenu(['name' => 'main', 'loginLink' => false]);

?>
<header>
  <nav class="navbar navbar-light navbar-expand-lg justify-content-between">
    <div class="container">
      <button class="navbar-toggler text-primary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-cogs"></i>
      </button>
      <ul class="top-header-options d-block d-lg-none">
        <li><a class="font-size" href="#"><span class="font-shrink">A</span> <span class="font-reset">A</span> <span class="font-grow">A</span></a></li>
        <li><a class="wcag_toggle" id="WCAG" href="#"><svg version="1.1" id="Capa_1a" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><g><path d="M256,0C114.509,0,0,114.497,0,256c0,141.491,114.497,256,256,256c141.491,0,256-114.497,256-256
                                                                                                                                                                                                        C512,114.509,397.503,0,256,0z M271,481.513V30.487C387.26,38.051,482,134.618,482,256C482,377.349,387.315,473.945,271,481.513z"/></g></g></svg></a></li>


      </ul>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="top-header">
          <div class="flex">

            <div class="c-2">
              <ul class="top-header-links">
                <li>
                  <a href="/" data-toggle="tooltip" title="Platforma Obsługi Szkoleń" style="opacity:0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="19.2175mm"
                         height="15.2716mm" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                         viewBox="0 0 450.01 381.03" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <g id="Warstwa_x0020_1">
                        <metadata id="CorelCorpID_0Corel-Layer" />
                        <path class="fil0" d="M141.6 66.77l-110.05 0c-17.4,0 -31.55,14.36 -31.55,31.76l0 186.58c0,17.4 14.16,31.55 31.55,31.55l107.28 0 0 35.34 94.66 0 0 -35.34 109.38 0c17.4,0 30.71,-14.16 30.71,-31.55l0 -117.44 -0.94 0.22c-2.17,13.41 -6.1,28.37 -17.6,34.31l0 83.48c0,6.8 -5.63,12.44 -12.44,12.44l-311.04 0c-6.8,0 -12.44,-5.63 -12.44,-12.44l0 -187.93c0,-6.8 5.63,-12.44 12.44,-12.44l101.81 0c2.42,-6.27 5.21,-12.54 8.26,-18.53l-0.02 -0.02z" />
                        <path class="fil0" d="M269.22 352l-163.92 0c-14.83,0 -27.46,13.88 -30.47,29.03l224.77 0c-3,-15.15 -15.54,-29.03 -30.37,-29.03z" />
                        <path id="surface1a" class="fil1" d="M102.54 0l198.55 24.82 148.92 99.28c-105.73,0 45.73,0 -99.57,0 2.73,1.74 -5.61,54.6 -7.64,54.48l-110.35 26.48 -80.66 -91.14c0,0 7.37,-30.53 23.95,-52.87l-73.19 -61.05z" />
                      </g>
                    </svg>
                  </a>
                </li>
                <li>
                  <a href="<?= Url::to(['newsletter']) ?>" data-toggle="tooltip" title="Newsletter" title="Formularz zapisu do Newslettera">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                         xml:space="preserve">
                      <g>
                        <g>
                          <path d="M508.963,185.841l-29.026-21.536V39.577c0-4.15-3.364-7.515-7.515-7.515H301.506c-0.29-0.302-41.028-30.583-41.028-30.583
                                c-2.659-1.973-6.296-1.974-8.956,0l-41.22,30.583H39.577c-4.15,0-7.515,3.365-7.515,7.515v124.727L3.037,185.84
                                C1.145,187.191,0,189.568,0,191.875v312.611C0,508.636,3.365,512,7.515,512h496.971c3.77,0,7.047-2.935,7.466-6.678
                                c0.031-0.275,0.049-0.553,0.049-0.836V191.876C512,189.473,510.811,187.319,508.963,185.841z M479.937,183.02l11.247,8.344
                                l-11.247,7.075V183.02z M256,16.872l20.475,15.191h-40.949L256,16.872z M47.092,47.092h417.816v160.8l-26.303,16.546h-72.89
                                c-4.151,0-7.515,3.365-7.515,7.515c0,4.15,3.364,7.515,7.515,7.515h48.997L256,339.303L97.289,239.468h232.355
                                c4.151,0,7.515-3.365,7.515-7.515c0-4.15-3.364-7.515-7.515-7.515H73.396l-26.304-16.546V47.092z M32.063,183.02v15.419
                                l-11.247-7.075L32.063,183.02z M15.029,496.971V205.479l463.396,291.491H15.029z M496.971,490.881L270.114,348.18l226.857-142.701
                                V490.881z" />
                        </g>
                      </g>
                      <g>
                        <g>
                          <path d="M416.313,88.172h-64.125c-4.151,0-7.515,3.365-7.515,7.515v80.157c0,4.15,3.365,7.515,7.515,7.515h64.125
                                c4.151,0,7.515-3.365,7.515-7.515V95.687C423.828,91.537,420.464,88.172,416.313,88.172z M408.799,168.329h-49.096v-65.127h49.096
                                V168.329z" />
                        </g>
                      </g>
                      <g>
                        <g>
                          <path d="M320.125,88.172H95.687c-4.15,0-7.515,3.365-7.515,7.515s3.365,7.515,7.515,7.515h224.438
                                c4.151,0,7.515-3.365,7.515-7.515S324.276,88.172,320.125,88.172z" />
                        </g>
                      </g>
                      <g>
                        <g>
                          <path d="M216.423,128.251H95.687c-4.15,0-7.515,3.365-7.515,7.515c0,4.15,3.365,7.515,7.515,7.515h120.736
                                c4.15,0,7.515-3.365,7.515-7.515C223.937,131.615,220.573,128.251,216.423,128.251z" />
                        </g>
                      </g>
                      <g>
                        <g>
                          <path d="M320.125,128.251h-72.141c-4.15,0-7.515,3.365-7.515,7.515c0,4.15,3.365,7.515,7.515,7.515h72.141
                                c4.151,0,7.515-3.365,7.515-7.515C327.64,131.615,324.276,128.251,320.125,128.251z" />
                        </g>
                      </g>
                      <g>
                        <g>
                          <path d="M256.501,168.329H95.687c-4.15,0-7.515,3.365-7.515,7.515s3.365,7.515,7.515,7.515h160.814
                                c4.151,0,7.515-3.365,7.515-7.515S260.652,168.329,256.501,168.329z" />
                        </g>
                      </g>
                      <g>
                        <g>
                          <path d="M320.125,168.329h-32.063c-4.151,0-7.515,3.365-7.515,7.515s3.364,7.515,7.515,7.515h32.063
                                c4.151,0,7.515-3.365,7.515-7.515S324.276,168.329,320.125,168.329z" />
                        </g>
                      </g>
                      <g>
                        <g>
                          <path d="M336.157,256.501h-40.078c-4.151,0-7.515,3.365-7.515,7.515c0,4.15,3.364,7.515,7.515,7.515h40.078
                                c4.151,0,7.515-3.365,7.515-7.515C343.671,259.866,340.308,256.501,336.157,256.501z" />
                        </g>
                      </g>
                      <g>
                        <g>
                          <path d="M264.016,256.501h-88.172c-4.15,0-7.515,3.365-7.515,7.515c0,4.15,3.365,7.515,7.515,7.515h88.172
                                c4.151,0,7.515-3.365,7.515-7.515C271.53,259.866,268.167,256.501,264.016,256.501z" />
                        </g>
                      </g>
                      <g>
                        <g>
                          <path d="M247.984,296.579h-32.063c-4.15,0-7.515,3.365-7.515,7.515s3.365,7.515,7.515,7.515h32.063
                                c4.15,0,7.515-3.365,7.515-7.515S252.135,296.579,247.984,296.579z" />
                        </g>
                      </g>
                      <g>
                        <g>
                          <path d="M288.063,296.579h-16.031c-4.151,0-7.515,3.365-7.515,7.515s3.364,7.515,7.515,7.515h16.031
                                c4.151,0,7.515-3.365,7.515-7.515S292.214,296.579,288.063,296.579z" />
                        </g>
                      </g>

                    </svg>
                  </a>
                </li>
                <li>
                  <a href="http://szkolenia.oeiizk.edu.pl/" data-toggle="tooltip" title="Moodle" target="_blank" title="Platforma szkoleniowa ośrodka - Moodle (nowa zakładka)">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" style="height:32px;position:relative;top:-2px;" version="1.1">
                      <path d="M18 7l-8 1-6 4h1v10h1V12h2.012c-.11.07.226 2.2.308 2.195l4.446 1.067 3.25-3.672s-.297-1.23-.965-2.13zm4.5 4c-1.57 0-2.992.676-3.996 1.742A2.35 2.35 0 0 0 17 12l-2 2.281c1.23.367 2 1.25 2 2.219V24h3v-7.5c0-1.398 1.102-2.5 2.5-2.5s2.5 1.102 2.5 2.5V24h3v-7.5c0-3.02-2.48-5.5-5.5-5.5zM8.973 15.406C8.949 15.602 9 24 9 24h3l-.004-7.656z"
                            id="surface1" />

                    </svg>

                  </a>
                </li>
                <li>
                  <a href="http://www.facebook.com/oeiizk" data-toggle="tooltip" title="Facebook" target="_blank" title="Strona ośrodka na Facebooku (nowa zakładka)" >
                    <svg version="1.1" id="Capa_1b" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px" width="96.124px" height="96.123px" viewBox="0 0 96.124 96.123"
                         style="enable-background:new 0 0 96.124 96.123;" xml:space="preserve">
                      <g>
                        <path d="M72.089,0.02L59.624,0C45.62,0,36.57,9.285,36.57,23.656v10.907H24.037c-1.083,0-1.96,0.878-1.96,1.961v15.803
                              c0,1.083,0.878,1.96,1.96,1.96h12.533v39.876c0,1.083,0.877,1.96,1.96,1.96h16.352c1.083,0,1.96-0.878,1.96-1.96V54.287h14.654
                              c1.083,0,1.96-0.877,1.96-1.96l0.006-15.803c0-0.52-0.207-1.018-0.574-1.386c-0.367-0.368-0.867-0.575-1.387-0.575H56.842v-9.246
                              c0-4.444,1.059-6.7,6.848-6.7l8.397-0.003c1.082,0,1.959-0.878,1.959-1.96V1.98C74.046,0.899,73.17,0.022,72.089,0.02z" />
                      </g>
                    </svg>
                  </a>
                </li>
                <li>
                  <a href="http://www.youtube.com/OEIiZKwWarszawie" data-toggle="tooltip" title="Youtube" target="_blank" title="Strona kanału ośrodka na Youtube (nowa zakładka)">
                    <svg version="1.1" id="Capa_1c" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                         xml:space="preserve">
                      <g>
                        <g>
                          <path d="M490.24,113.92c-13.888-24.704-28.96-29.248-59.648-30.976C399.936,80.864,322.848,80,256.064,80
                                c-66.912,0-144.032,0.864-174.656,2.912c-30.624,1.76-45.728,6.272-59.744,31.008C7.36,138.592,0,181.088,0,255.904
                                C0,255.968,0,256,0,256c0,0.064,0,0.096,0,0.096v0.064c0,74.496,7.36,117.312,21.664,141.728
                                c14.016,24.704,29.088,29.184,59.712,31.264C112.032,430.944,189.152,432,256.064,432c66.784,0,143.872-1.056,174.56-2.816
                                c30.688-2.08,45.76-6.56,59.648-31.264C504.704,373.504,512,330.688,512,256.192c0,0,0-0.096,0-0.16c0,0,0-0.064,0-0.096
                                C512,181.088,504.704,138.592,490.24,113.92z M192,352V160l160,96L192,352z" />
                        </g>
                      </g>
                    </svg>
                  </a>
                </li>
                <li>
                  <a href="https://www.oeiizk.waw.pl/sklepik/" target="_blank" title= "Przenosi do nowej zakładki">
                    Sklepik
                  </a>
                </li>
                <li>
                  <a href="http://bip.oeiizk.waw.pl/" target="_blank" title="Strona Biuletynu Informacji Publicznej OEIiZK (nowa zakładka)">
                    <img src="/images/bip-logo.png" alt="BIP">
                  </a>
                </li>
              </ul>
            </div>
            <div class="c-3 ml-auto">
              <ul class="top-header-options">
                <li class="d-none d-md-block"><a class="font-size" href="#"><span class="font-shrink">A</span> <span class="font-reset">A</span> <span class="font-grow">A</span></a></li>
                <li class="d-none d-md-block">
                  <a class="wcag_toggle" href="#">
                    <svg version="1.1" id="Capa_1d" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                         xml:space="preserve">
                      <g>
                        <g>
                          <path d="M256,0C114.509,0,0,114.497,0,256c0,141.491,114.497,256,256,256c141.491,0,256-114.497,256-256
                                C512,114.509,397.503,0,256,0z M271,481.513V30.487C387.26,38.051,482,134.618,482,256C482,377.349,387.315,473.945,271,481.513z" />
                        </g>
                      </g>
                    </svg>
                  </a>
                </li>
                <?php /*
                <li>
                  <a id="search-button" href="#">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                         xml:space="preserve">
                      <g>
                        <g>
                          <path d="M310,190c-5.52,0-10,4.48-10,10s4.48,10,10,10c5.52,0,10-4.48,10-10S315.52,190,310,190z" />
                        </g>
                      </g>
                      <g>
                        <g>
                          <path d="M500.281,443.719l-133.48-133.48C388.546,277.485,400,239.555,400,200C400,89.72,310.28,0,200,0S0,89.72,0,200
                                s89.72,200,200,200c39.556,0,77.486-11.455,110.239-33.198l36.895,36.895c0.005,0.005,0.01,0.01,0.016,0.016l96.568,96.568
                                C451.276,507.838,461.319,512,472,512c10.681,0,20.724-4.162,28.278-11.716C507.837,492.731,512,482.687,512,472
                                S507.837,451.269,500.281,443.719z M305.536,345.727c0,0.001-0.001,0.001-0.002,0.002C274.667,368.149,238.175,380,200,380
                                c-99.252,0-180-80.748-180-180S100.748,20,200,20s180,80.748,180,180c0,38.175-11.851,74.667-34.272,105.535
                                C334.511,320.988,320.989,334.511,305.536,345.727z M326.516,354.793c10.35-8.467,19.811-17.928,28.277-28.277l28.371,28.371
                                c-8.628,10.183-18.094,19.65-28.277,28.277L326.516,354.793z M486.139,486.139c-3.78,3.78-8.801,5.861-14.139,5.861
                                s-10.359-2.081-14.139-5.861l-88.795-88.795c10.127-8.691,19.587-18.15,28.277-28.277l88.798,88.798
                                C489.919,461.639,492,466.658,492,472C492,477.342,489.919,482.361,486.139,486.139z" />
                        </g>
                      </g>
                      <g>
                        <g>
                          <path d="M200,40c-88.225,0-160,71.775-160,160s71.775,160,160,160s160-71.775,160-160S288.225,40,200,40z M200,340
                                c-77.196,0-140-62.804-140-140S122.804,60,200,60s140,62.804,140,140S277.196,340,200,340z" />
                        </g>
                      </g>
                      <g>
                        <g>
                          <path d="M312.065,157.073c-8.611-22.412-23.604-41.574-43.36-55.413C248.479,87.49,224.721,80,200,80c-5.522,0-10,4.478-10,10
                                c0,5.522,4.478,10,10,10c41.099,0,78.631,25.818,93.396,64.247c1.528,3.976,5.317,6.416,9.337,6.416
                                c1.192,0,2.405-0.215,3.584-0.668C311.472,168.014,314.046,162.229,312.065,157.073z" />
                        </g>
                      </g>

                    </svg>

                  </a>
                </li> */ ?>
                <li>
                  <a href="/art/pomoc" target="_blank" title="Link do pomocy obsługi Platformy Obsługi Szkoleń (nowa zakładka) ">POMOC</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <?php /*
  <div class="search-box">
    <div class="container">
      <form method="POST" action="/">
        <input type="text" placeholder="Czego szukam?"/>
        <input type="submit" value="szukaj"/>
      </form>
    </div>
  </div>*/ ?>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="center-header">
          <div class="flex align-items-center">
            <div class="logo1 pr-1 pr-lg-4">
              <a class="logo-wrapper" href="/" title="Logo - Platformy Obsługi Szkoleń (POS - strona główna)">
                <img id="logo" src="/images/logo.png" alt="Logo">

              </a>
            </div>
            <div class="logo2 px-1 px-lg-4 border-left border-light">
              <a href="https://www.oeiizk.waw.pl" class="logo-wrapper" target="_blank" title="Logo - napis OEIiZK (Ośrodek Edukacji Informatycznej i Zastosowań Komputerów w Warszawie), przenosi do nowej zakładki ze stroną ośrodka">
                <img id="logo-oeiizk" src="/images/svg/logo_oeiizk.svg" alt="Logo">
              </a>
            </div>
            <div class="user-col ml-auto">
              <div class="d-flex  user full-h">
                <? if (MgHelpers::getUserModel()): ?>
                <?$user = MgHelpers::getUserModel()?>
                  <div class="profile-progress">
                    <span><?=$user->credibilityCalc?>%</span>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: <?=$user->credibilityCalc?>%" aria-valuenow="<?=$user->credibilityCalc?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>

                  <a href="<?= Url::to(['/my-account']) ?>" class="px-3" ><?= $user ?></a>

                  <a href="<?= Url::to(['site/logout']) ?>" class="red border-left border-right border-light px-3" >Wyloguj</a>
                <? else: ?>
                  <a href="<?= Url::to(['site/login']) ?>" class="red border-left border-right border-light px-3" >Logowanie do systemu</a>
                <? endif ?>

              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
    <? if ($menu): ?>
      <? if ($this->beginCache('header_menu')) { ?>
        <nav id="navbar" class="navbar navbar-expand-lg">
          <a id="burger" href="#">
            <i class="fa fa-bars" aria-hidden="true"></i>
          </a>
          <ul id="main-menu">
            <? foreach ($menu->getItems() as $item): ?>
              <? if (isset($item['url'])): ?>
                <li>
                  <a href="<?= Url::to($item['url']) ?>">
                    <span><?= $item['label'] ?></span>
                  </a>
                  <? if (!empty($item['items'])): ?>
                    <ul>
                      <? foreach ($item['items'] as $subItem): ?>
                        <? if ($subItem['url']): ?>
                          <li>
                            <a href="<?= Url::to($subItem['url']) ?>">
                              <?= $subItem['label'] ?>
                            </a>
                          </li>
                        <? endif ?>
                      <? endforeach ?>
                    </ul>
                  <? endif ?>
                </li>
              <? endif ?>
            <? endforeach ?>
          </ul>
        </nav>
        <?php $this->endCache();
      }

      ?>
<? endif ?>

  </div>
</header>
