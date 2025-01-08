<? get_header(); ?>

<section class="documentation container">
  <div class="documentation__title title">Нормативная документация</div>
  <div class="documentation__body">
    <? foreach (get_field('group') as $item): ?>
      <div class="documentation__block">
        <? foreach ($item['documentation'] as $item2): ?>
          <a class="documentation__item" href="<?= $item2['url'] ?>" download>
            <?= $item2['name'] ?>
          </a>
        <? endforeach; ?>
      </div>
    <? endforeach; ?>
  </div>
</section>
<section id="contact" class="contact">
  <div class="contact-form">
    <h2 class="title">Связаться с нами</h2>
    <form id="ajax-contact-form" class="contact-form__form">
      <input type="hidden" name="action" value="send_email">
      <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('form_nonce'); ?>">

      <input class="form-control" type="text" name="name" placeholder="Ваше имя" required />
      <input class="form-control" type="email" name="email" placeholder="Ваш email" required />
      <input class="form-control" type="tel" name="phonenumber" placeholder="Ваш телефон" required />
      <textarea class="form-control" name="message" placeholder="Ваше сообщение" rows="7"></textarea>
      <button class="button" type="submit">Отправить</button>
    </form>
    <div id="form-response" style="margin-top: 10px;"></div>
  </div>
  <div class="contact-advantages">
    <? foreach (get_field('advantages', 'option') as $item): ?>
      <div class="contact-advantages__item"><?= $item['content'] ?></div>
    <? endforeach; ?>
  </div>
</section>

<? get_footer(); ?>

