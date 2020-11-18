<div class="row header">
  <div class="col-12 col-lg order-3 order-lg-1 mt-4 mt-lg-0">
    <h1>Twoje konto</h1>
  </div>
  <div class="col-12 col-lg text-right order-2 order-lg-2">
    Data potwierdzenia maila: <strong><?= \app\components\mgcms\MgHelpers::getUserModel()->date_email_confirmation ?></strong>
  </div>
  <div class="col-12 col-lg text-right order-2 order-lg-2">
    Ostatnie logowanie: <strong><?= \app\components\mgcms\MgHelpers::getUserModel()->last_login ?></strong>
  </div>
</div>