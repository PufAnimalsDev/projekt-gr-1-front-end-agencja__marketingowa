<?php

add_action("rest_api_init", function () {
    register_rest_route("workon", "/formwizard", [
        "methods" => "POST",
        "callback" => function ($request) {
            return json_encode([
                "status" => "success",
                "request" => var_export($request, true)
            ]);
        }
    ]);

    register_rest_route("workon", "/newsletter", [
        "methods" => "POST",
        "callback" => function ($request) {
            return json_encode([
                "status" => "success",
                "request" => var_export($request, true)
            ]);
        }
    ]);
});
