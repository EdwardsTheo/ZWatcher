<?php
                $to      = 'thomasparis56@gmail.com';
                $subject = 'test Mail';
                $message = 'Salut je teste des trucs';
                $headers = 'From: "ZWatcher"<noreply@zwatcher.com>' . "\r\n" .
                'Reply-To: noreply@zwatcher.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $message, $headers);

                echo(error_get_last()['message']);
                ?> 