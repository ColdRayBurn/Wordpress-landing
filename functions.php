<?

function enqueue_assets() {
    wp_enqueue_style('theme_style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('style_main', get_template_directory_uri() . '/assets/styles/main-nnwQQyV6.css');

    if (is_front_page())
    {
        wp_enqueue_style('style_home', get_template_directory_uri() . '/assets/styles/home-VaPLNGqB.css');
        wp_script_add_data('script_home', 'strategy', 'defer');
    }

    if (is_page('documentation'))
    {
        wp_enqueue_style('style_documentation', get_template_directory_uri() . '/assets/styles/documentation-C8c1GnrS.css');
    }
}

add_action('wp_enqueue_scripts', 'enqueue_assets');

add_action('wp_ajax_send_email', 'handle_form_submission');
add_action('wp_ajax_nopriv_send_email', 'handle_form_submission');

function handle_form_submission() {
    // Проверяем nonce
    check_ajax_referer('form_nonce', 'nonce');

    // Получаем данные из формы
    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $phone = sanitize_text_field($_POST['phonenumber'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    // Проверка на заполненность
    if (empty($name) || empty($email) || empty($phone))
    {
        wp_send_json_error(['message' => 'Поля "имя", "почта" и "телефон" обязательны для заполнения.']);
    }

    // Настраиваем письмо
    $to = 'info@projectechnology.ru';
    $subject = 'Проект Технология. Сообщение с контактной формы';
    $headers = ['Content-Type: text/html; charset=UTF-8'];
    $message = nl2br($message);  // Заменяет символы новой строки на <br>
    $body = "
        <h2>Новое сообщение с сайта Проект Технология</h2>
        <p><strong>Имя:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Телефон:</strong> $phone</p>
        <p><strong>Сообщение:</strong><br>$message</p>
    ";

    // Отправка письма
    if (wp_mail($to, $subject, $body, $headers))
    {
        wp_send_json_success(['message' => 'Сообщение успешно отправлено!']);
    } else
    {
        wp_send_json_error(['message' => 'Ошибка отправки письма.']);
    }
}

add_action('wp_footer', function () {
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('#ajax-contact-form');
            const responseDiv = document.querySelector('#form-response');

            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                const formData = new FormData(form);

                try {
                    const response = await fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                        method: 'POST',
                        body: formData
                    });

                    const result = await response.json();

                    if (result.success) {
                        responseDiv.innerHTML = `<p style="color: green;">${result.data.message}</p>`;
                        form.reset();
                    } else {
                        responseDiv.innerHTML = `<p style="color: red;">${result.data.message}</p>`;
                    }
                } catch (error) {
                    responseDiv.innerHTML = `<p style="color: red;">Ошибка отправки данных. Попробуйте позже.</p>`;
                }
            });
        });
    </script>
    <?php
});
