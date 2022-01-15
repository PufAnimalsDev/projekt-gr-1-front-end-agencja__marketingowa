<?php

add_action("rest_api_init", function () {
    register_rest_route("workon", "/newsletter", [
        "methods" => "POST",
        "callback" => function ($request) {
            $output = "";

            $email = $request["email"] ? $request["email"] : "";
            $name = $request["name"] ? $request["name"] : "";

            if ($name && !get_page_by_title($name, OBJECT, "subscriptions")) {
                $newPost = wp_insert_post([
                    "post_title" => $email,
                    "post_status" => "publish",
                    "post_type" => "subscriptions"
                ]);

                update_field('name', $name, $newPost);
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

add_action("rest_api_init", function () {
    register_rest_route("workon", "/formwizard", [
        "methods" => "POST",
        "callback" => function ($request) {
            $output = "";

            $name = $request["name"] ? $request["name"] : "";
            $company_name = $request["company_name"] ? $request["company_name"] : "";
            $email = $request["email"] ? $request["email"] : "";
            $phone = $request["phone"] ? $request["phone"] : "";
            $company_goal = $request["company_goal"] ? $request["company_goal"] : "";
            $why_us = $request["why_us"] ? $request["why_us"] : "";
            $decision_help = $request["decision_help"] ? $request["decision_help"] : "";
            $extra_info = $request["extra_info"] ? $request["extra_info"] : "";
            $topic = $request["topic"] ? $request["topic"] : "";
            $file = $request["file"] ? $request["file"] : "";


            if ($name && !get_page_by_title($name, OBJECT, "wizard")) {
                $newPost = wp_insert_post([
                    "post_title" => $company_name,
                    "post_status" => "publish",
                    "post_type" => "wizard"
                ]);

                update_field('surname', $name, $newPost);
                update_field('email', $email, $newPost);
                update_field('phone', $phone, $newPost);
                update_field('company_goal', $company_goal, $newPost);
                update_field('why_us', $why_us, $newPost);
                update_field('decision_help', $decision_help, $newPost);
                update_field('extra_info', $extra_info, $newPost);
                update_field('topic', $topic, $newPost);
                update_field('file', $file, $newPost);

                if ($newPost) {
                    wp_mail($email, 'Test', 'Hej ho wysłałeś formularz', 'Standard email body message');
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
