USE blog;

INSERT INTO
	carousel(
		image_1,
        image_2,
        image_3,
        image_4,
        image_5
    )
VALUES(
	'/images/1.png',
    '/images/2.png',
    '/images/3.png',
    '/images/4.png',
    '/images/5.png'
),

(
	'/images/5.png',
    '/images/4.png',
    '/images/3.png',
    '',
    ''
),
(
	'/images/5.png',
    '/images/4.png',
    '/images/3.png',
    '',
    ''
),
(
	'/images/5.png',
    '/images/4.png',
    '/images/3.png',
    '',
    ''
),
(
	'/images/5.png',
    '/images/4.png',
    '/images/3.png',
    '',
    ''
),
(
	'/images/5.png',
    '/images/4.png',
    '/images/3.png',
    '',
    ''
),
(
	'/images/5.png',
    '/images/4.png',
    '/images/3.png',
    '',
    ''
),
(
	'/images/5.png',
    '/images/4.png',
    '/images/3.png',
    '',
    ''
),
(
	'/images/5.png',
    '/images/4.png',
    '/images/3.png',
    '',
    ''
);

INSERT INTO
	post(
		id_carousel,
        id_user,
        publish_date,
        descr
)
    
VALUES(
	1,
    1,
    '2010-01-03 04:30:43',
    'Пост номер 1, проверка связи'
),

(
	2,
    1,
    '2010-01-03 04:30:43',
    'Пост номер 2, проверка связи'
),
(
	3,
    1,
    '2010-01-03 04:30:43',
    'Пост номер 3, проверка связи'
),
(
	4,
    1,
    '2010-01-03 04:30:43',
    'Пост номер 4, проверка связи'
),
(
	5,
    1,
    '2010-01-03 04:30:43',
    'Пост номер 5, проверка связи'
),
(
	4,
    2,
    '2010-01-03 04:30:43',
    'Пост номер 6, проверка связи'
),
(
	2,
    2,
    '2010-01-03 04:30:43',
    'Пост номер 7, проверка связи'
),
(
	3,
    2,
    '2010-01-03 04:30:43',
    'Пост номер 8, проверка связи'
)