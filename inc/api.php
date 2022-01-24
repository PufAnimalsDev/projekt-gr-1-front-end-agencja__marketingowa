<?php

require_once(ABSPATH . 'wp-admin/includes/image.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/media.php');


add_action("rest_api_init", function () {
    register_rest_route("workon", "/newsletter", [
        "methods" => "POST",
        "callback" => function ($request) {

            if ($request["email"] && mb_strlen($request["email"]) <= 255) {
                $email = sanitize_text_field($request["email"]);
            } else {
                return new WP_REST_RESPONSE(array(
                    "response" => "error",
                    "reason" => "Adres e-mail jest nieprawidłowy"
                ), 400);
            };

            if ($request["name"] && mb_strlen($request["name"]) <= 255) {
                $name = sanitize_text_field($request["name"]);
            } else {
                return new WP_REST_RESPONSE(array(
                    "response" => "error",
                    "reason" => "Imię jest nieprawidłowe"
                ), 400);
            };

            if (get_page_by_title($email, OBJECT, "subscriptions")) {
                return new WP_REST_RESPONSE(array(
                    "response" => "error",
                    "reason" => "Ten adres e-mail jest już zasubskrybowany"
                ), 400);
            }

            $newPost = wp_insert_post([
                "post_title" => $email,
                "post_status" => "publish",
                "post_type" => "subscriptions"
            ]);

            if ($newPost) {
                update_field('name', $name, $newPost);
                wp_mail(
                    $email,
                    'Test',
                    '<h2>Cześć ' . $name . ' Witamy na pokładzie!</h2>
                    <p>Dziękujęmy za subskrybcję naszego Newsletter-a.</p>
                    <p>Dzięki naszej korespondencji dowiesz się więcej o nowościach w naszej agencji i w marketingu.</p>
                    <p>Serdecznie pozdrawiaamy, Zespół Peacocko Agency</p>',
                    'Standard email body message'
                );
                return new WP_REST_RESPONSE(array(
                    "response" => "success"
                ), 200);
            } else {
                return new WP_REST_RESPONSE(array(
                    "response" => "error",
                    "reason" => "Błąd serwera. Spróbuj ponownie później"
                ), 500);
            }
        }
    ]);
});

add_action("rest_api_init", function () {
    register_rest_route("workon", "/formwizard", [
        "methods" => "POST",
        "callback" => function ($request) {

            if ($request["topic"] && mb_strlen($request["topic"]) <= 255) {
                $topic = sanitize_text_field($request["topic"]);
            } else {
                return new WP_REST_RESPONSE(array(
                    "response" => "error",
                    "reason" => "Krok 1 jest nieprawidłowy"
                ), 400);
            };

            if ($request["company_goal"] && mb_strlen($request["company_goal"]) <= 10000) {
                $company_goal = sanitize_text_field($request["company_goal"]);
            } else {
                return new WP_REST_RESPONSE(array(
                    "response" => "error",
                    "reason" => "Cel firmy jest nieprawidłowy"
                ), 400);
            };

            if ($request["company_goal_deadline"] && mb_strlen($request["company_goal_deadline"]) <= 255) {
                $company_goal_deadline = sanitize_text_field($request["company_goal_deadline"]);
            } else {
                return new WP_REST_RESPONSE(array(
                    "response" => "error",
                    "reason" => "Termin osiągnięcia celu firmy jest nieprawidłowy"
                ), 400);
            };

            if ($request["budget_min"] && mb_strlen($request["budget_min"]) <= 255) {
                $budget_min = sanitize_text_field($request["budget_min"]);
            } else {
                return new WP_REST_RESPONSE(array(
                    "response" => "error",
                    "reason" => "Budżet jest nieprawidłowy"
                ), 400);
            };

            if ($request["budget_max"] && mb_strlen($request["budget_max"]) <= 255) {
                $budget_max = sanitize_text_field($request["budget_max"]);
            } else {
                return new WP_REST_RESPONSE(array(
                    "response" => "error",
                    "reason" => "Budżet jest nieprawidłowy"
                ), 400);
            };

            if ($request["why_us"] && mb_strlen($request["why_us"]) <= 255) {
                $why_us = sanitize_text_field($request["why_us"]);
            } else {
                return new WP_REST_RESPONSE(array(
                    "response" => "error",
                    "reason" => "Pole 'Dlaczego my?' jest nieprawidłowe"
                ), 400);
            };

            if ($request["name"] && mb_strlen($request["name"]) <= 255) {
                $name = sanitize_text_field($request["name"]);
            } else {
                return new WP_REST_RESPONSE(array(
                    "response" => "error",
                    "reason" => "Imię i nazwisko są nieprawidłowe"
                ), 400);
            };

            if ($request["company_name"] && mb_strlen($request["company_name"]) <= 500) {
                $company_name = sanitize_text_field($request["company_name"]);
            } else {
                return new WP_REST_RESPONSE(array(
                    "response" => "error",
                    "reason" => "Nazwa firmy jest nieprawidłowa"
                ), 400);
            };

            if ($request["company_job_title"] && mb_strlen($request["company_job_title"]) <= 255) {
                $company_job_title = sanitize_text_field($request["company_job_title"]);
            } else {
                $company_job_title = "brak";
            };

            if ($request["email"] && mb_strlen($request["email"]) <= 255) {
                $email = sanitize_text_field($request["email"]);
            } else {
                return new WP_REST_RESPONSE(array(
                    "response" => "error",
                    "reason" => "Adres e-mail jest nieprawidłowy"
                ), 400);
            };

            if ($request["phone"] && mb_strlen($request["phone"]) <= 255) {
                $phone = sanitize_text_field($request["phone"]);
            } else {
                $phone = "brak";
            };

            if ($request["extra_info"] && mb_strlen($request["extra_info"]) <= 10000) {
                $extra_info = sanitize_text_field($request["extra_info"]);
            } else {
                $extra_info = "brak";
            };

            $newPost = wp_insert_post([
                "post_title" => $company_name,
                "post_status" => "publish",
                "post_type" => "wizard"
            ]);

            if ($newPost) {
                update_field('surname', $name, $newPost);
                update_field('company_name', $company_name, $newPost);
                update_field('company_job_title', $company_job_title, $newPost);
                update_field('email', $email, $newPost);
                update_field('phone', $phone, $newPost);
                update_field('company_goal', $company_goal, $newPost);
                update_field('company_goal_deadline', $company_goal, $newPost);
                update_field('budget_min', $budget_min, $newPost);
                update_field('budget_max', $budget_max, $newPost);
                update_field('why_us', $why_us, $newPost);
                update_field('extra_info', $extra_info, $newPost);
                update_field('topic', $topic, $newPost);

                if (!empty($_FILES["file"])) {
                    $file = media_handle_upload("file", $newPost);
                    update_field('file', $file, $newPost);
                }

                wp_mail(
                    $email,
                    'Test',
                    '<h1>' . $company_name . ' Witajcie na pokładzie!</h1>
                        <h2>Wygląda na to, że wyraziliście chęć współpracy. Poniżej znajduje się podsumowanie, formularza, który do nas wysłaliście:</h2>
                        <h3 style="color: #FFB400;">Z czym możemy Wam pomóc?</h3>
                        <p>' . $topic . '</p>
                        <h3 style="color: #FFB400;">Jaki jest cel Waszej firmy?</h3>
                        <p>' . $company_goal . '</p>
                        <h3 style="color: #FFB400;">Do kiedy Wasza firma chce go osiągnąć?</h3>
                        <p>' . $company_goal_deadline . '</p>
                        <h3 style="color: #FFB400;">Ile wynosi budżet przeznaczony na realizację tego celu?</h3>
                        <p>' . $budget_min . ' - ' . $budget_max . ' zł </p>
                        <h3 style="color: #FFB400;">Dlaczego wybraliście nas?</h3>
                        <p>' . $why_us . '</p>
                        <h3 style="color: #FFB400;">Wasze dane kontaktowe: </h3>
                        <p>Imie i nazwisko: ' . $name . '</p>
                        <p>Nazwa firmy: ' . $company_name . '</p>
                        <p>Stanowisko: ' . $company_job_title . '</p>
                        <p>Email: ' . $email . '</p>
                        <p>Telefon: ' . $phone . '</p>
                        <h3 style="color: #FFB400;">Dodatkowe informacje:</h3>
                        <p>' . $extra_info . '</p>
                        <h3 style="color: #FFB400;">Jeszcze raz gorąco witamy!</h3>
                        <p>Jeżeli załączyłeś pliki to zapoznamy się z nimi. Oczekuj, że niedługo się odezwiemy.</p>
                        <p>W przypadku gdyby coś się niezgadzało. Odezwij się do nas: </p>
                        <p>Email: pecocko@gmial.com</p>
                        <p>Telefon: 123456789 </p>
                        <p>Serdecznie pozdrawiaamy, Zespół Peacocko Agency</p>',
                    'Standard email body message'
                );

                return new WP_REST_RESPONSE(array(
                    "response" => "success"
                ), 200);
            } else {
                return new WP_REST_RESPONSE(array(
                    "response" => "error",
                    "reason" => "Błąd serwera. Spróbuj ponownie później"
                ), 500);
            }
        }
    ]);
});

add_action("rest_api_init", function () {
    register_rest_route("workon", "/formcareer", [
        "methods" => "POST",
        "callback" => function ($request) {
            $output = "";

            $name = $request["first_name"] ? $request["first_name"] : "";
            $last_name = $request["last_name"] ? $request["last_name"] : "";
            $email = $request["email"] ? $request["email"] : "";
            $phone = $request["phone"] ? $request["phone"] : "";
            $salary = $request["salary"] ? $request["salary"] : "";
            $join_reason = $request["join_reason"] ? $request["join_reason"] : "";
            $extra_questions = $request["extra_questions"] ? $request["extra_questions"] : "";

            if ($join_reason && !get_page_by_title($join_reason, OBJECT, "work")) {
                $newPost = wp_insert_post([
                    "post_title" => $name,
                    "post_status" => "publish",
                    "post_type" => "work"
                ]);

                update_field('first_name', $name, $newPost);
                update_field('last_name', $last_name, $newPost);
                update_field('email', $email, $newPost);
                update_field('phone', $phone, $newPost);
                update_field('salary', $salary, $newPost);
                update_field('join_reason', $join_reason, $newPost);
                update_field('extra_questions', $extra_questions, $newPost);


                if (!empty($_FILES["cv"])) {
                    $cv = media_handle_upload("cv", $newPost);
                    update_field('cv', $cv, $newPost);
                }

                if (!empty($_FILES["extra_file"])) {
                    $extra_file = media_handle_upload("extra_file", $newPost);
                    update_field('extra_file', $extra_file, $newPost);
                }


                if ($newPost) {
                    wp_mail(
                        $email,
                        'Test',
                        '<h1>Dziękujemy za chęć współpracy!</h1>
                        <p>Informujemy, że skontaktujemy się tylko z wybranymi kandydatami.</p>
                        <p>W przypadku gdyby coś się niezgadzało. Odezwij się do nas: </p>
                        <p>Email: pecocko@gmial.com</p>
                        <p>Telefon: 123456789 </p>
                        <p>Serdecznie pozdrawiaamy, Zespół Peacocko Agency</p>',
                        'Standard email body message'
                    );
                }

                $output = $newPost ? json_encode([
                    "status" => "success",
                    "request" => var_export($request, true)
                ]) : json_encode([
                    "status" => "error",
                    "request" => var_export($request, true)
                ]);
            } else {
                $output = json_encode([
                    "status" => "error2",
                    "request" => var_export($request, true)
                ]);
            }

            return $output;
        }
    ]);
});

// register_rest_route("workon", "/formwizard", [
//     "methods" => "POST",
//     "callback" => function ($request) {
//         return json_encode([
//             "status" => "success",
//             "request" => var_export($request, true)
//         ]);
//     }
// ]);
