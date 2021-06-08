<?php

echo json_encode(
    password_verify(
        'rony@teste',
        '$argon2i$v=19$m=65536,t=4,p=1$d+pfD9te/oj47K30hfFbbA$l2mOP4PEttWjFfneZyTygNpCw/KxFTf+js8bk5/LO6Q'
    )
);
