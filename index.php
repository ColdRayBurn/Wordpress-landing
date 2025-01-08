<? get_header(); ?>

<section id="about-company" class="hero" style="background-image: url('<?= get_field('banner') ?>');">
  <div class="hero-text container">
    <h1 class="hero-text__title">
      <?= get_field('hero')['title'] ?>
    </h1>
    <p class="hero-text__description">
      <?= get_field('hero')['subtitle'] ?>
    </p>
    <a class="hero-text__button button" href="#contact">Заказать звонок</a>
  </div>
  <div class="text-block">
    <div class="container">
      <p class="text-block__content">
        Кoманда cпециалиcтов с высшим стpоитeльным образованием MГCУ и мнoгoлeтним oпытoм pаботы рaзработaет и
        coглаcуeт оргaнизациoнно-теxнолoгичecкую документaцию на все виды стpoитeльнo-монтажныx paбот
      </p>
    </div>
  </div>
</section>
<section id="services" class="services container">
  <? foreach (get_field('services') as $index => $item): ?>
    <div class="services__item" data-modal="services-<?= $index ?>">
      <?= $item['title'] ?>
    </div>
  <? endforeach; ?>
</section>
<section class="text-block" style="--background-image: url('<?= get_template_directory_uri() ?>/assets/images/unnamed_1.jpg')">
  <div class="container">
    <p class="text-block__content">
      Проектирование ведется в соответствии с актуальными действующими нормативами Имеются все необходимые
      документы. Большой опыт согласования документации в ГлавГосЭкспертизе (ГГЭ), МосГосЭкспертизе (МГЭ), и других
      инстанциях
    </p>
  </div>
</section>
<section class="customers container">
  <h2 class="customers__title title container">Наши заказчики</h2>
  <div class="customers__items">
    <? foreach (get_field('customers') as $customer): ?>
      <a class="customers__item" href="<?= $customer['url'] ?>" target="_blank" rel="noopener noreferrer" style="background-image: url('<?= $customer['image'] ?>')"></a>
    <? endforeach; ?>
  </div>
  <button class="customers__button button" type="button">
    Показать ещё
    <svg width="15" height="9" viewBox="0 0 15 9" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M13.875 1.125L7.5 7.125L1.125 1.125" stroke="currentColor" stroke-width="2" />
    </svg>
  </button>
</section>
<section id="documentation" class="documentation">
  <h2 class="documentation__title title container">Примеры проектов</h2>
  <div class="documentation-carousel">
    <div class="documentation-carousel__wrapper">
      <? foreach (get_field('documentation_gallery') as $item): ?>
        <img class="documentation-carousel__slide" src="<?= $item['image'] ?>" alt="" <?= $item['file'] ? 'data-file="' . $item['file'] . '"' : '' ?> />
      <? endforeach; ?>
    </div>
    <div class="documentation-carousel-navigation container">
      <button class="documentation-carousel-navigation__button documentation-carousel-navigation__button_previous" type="button">
        <svg viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M8 13.75L2 7.375L8 1" stroke="currentColor" stroke-width="2" />
        </svg>
      </button>
      <button class="documentation-carousel-navigation__button documentation-carousel-navigation__button_next" type="button">
        <svg viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1 1.25L7 7.625L1 14" stroke="currentColor" stroke-width="2" />
        </svg>
      </button>
    </div>
  </div>
</section>
<section class="contact">
  <div class="contact-form" id="contact">
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

<? foreach (get_field('services') as $index => $item): ?>
  <div class="modal" data-modal="services-<?= $index ?>">
    <div class="modal__backdrop"></div>
    <div class="modal__body">
      <div class="modal-projects">
        <div class="modal-projects__title"><?= $item['title'] ?></div>
        <div class="modal-projects__content">
          <?= $item['description'] ?>
        </div>
      </div>
      <button class="modal__close-button" type="button">
        <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M14.1213 2.12132L14.8284 1.41421L13.4142 0L12.7071 0.707107L7.41421 6L2.12132 0.707107L1.41421 0L0 1.41421L0.707107 2.12132L6 7.41421L0.707107 12.7071L0 13.4142L1.41421 14.8284L2.12132 14.1213L7.41421 8.82843L12.7071 14.1213L13.4142 14.8284L14.8284 13.4142L14.1213 12.7071L8.82843 7.41421L14.1213 2.12132Z" fill="currentColor" />
        </svg>
      </button>
    </div>
  </div>
<? endforeach; ?>

<div class="modal" data-modal="documentation">
  <div class="modal__backdrop"></div>
  <div class="modal__body">
    <div class="modal-documentation">
      <button class="modal-documentation-carousel__navigation-button modal-documentation-carousel__navigation-button_previous" type="button">
        <svg viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M8 13.75L2 7.375L8 1" stroke="currentColor" stroke-width="2" />
        </svg>
      </button>
      <div class="modal-documentation-carousel">
        <div class="modal-documentation-carousel__wrapper">
          <? foreach (get_field('documentation_gallery') as $item): ?>
            <img class="modal-documentation-carousel__slide" src="<?= $item['image'] ?>" alt="" />
          <? endforeach; ?>
        </div>
      </div>
      <button class="modal-documentation-carousel__navigation-button modal-documentation-carousel__navigation-button_next" type="button">
        <svg viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1 1.25L7 7.625L1 14" stroke="currentColor" stroke-width="2" />
        </svg>
      </button>
    </div>
    <button class="modal__close-button" type="button">
      <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.1213 2.12132L14.8284 1.41421L13.4142 0L12.7071 0.707107L7.41421 6L2.12132 0.707107L1.41421 0L0 1.41421L0.707107 2.12132L6 7.41421L0.707107 12.7071L0 13.4142L1.41421 14.8284L2.12132 14.1213L7.41421 8.82843L12.7071 14.1213L13.4142 14.8284L14.8284 13.4142L14.1213 12.7071L8.82843 7.41421L14.1213 2.12132Z" fill="currentColor" />
      </svg>
    </button>
  </div>
</div>

<script type="module" src="<?= get_template_directory_uri() ?>/assets/scripts/home-C65G5Mgj.js" defer></script>

<? get_footer(); ?>

