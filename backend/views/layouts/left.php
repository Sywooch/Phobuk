<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Użytkownicy', 'icon' => 'fa fa-user', 'url' => ['/user']],
                    ['label' => 'Zdjęcia', 'icon' => 'fa fa-photo', 'url' => ['/photo']],
                    ['label' => 'Posty', 'icon' => 'fa fa-newspaper-o', 'url' => ['/post']],
                    ['label' => 'Galerie', 'icon' => 'fa fa-camera', 'url' => ['/gallery']],
                    ['label' => 'Kometarze do zdjęć', 'icon' => 'fa fa-comments', 'url' => ['/photo-comment']],
                    ['label' => 'Kometarze do postów', 'icon' => 'fa fa-comments', 'url' => ['/post-comment']],
                    ['label' => 'Kategorie', 'icon' => 'fa fa-tag', 'url' => ['/category']],
                    ['label' => 'Marki aparatów', 'icon' => 'fa fa-camera-retro', 'url' => ['/camera-brand']],
                    ['label' => 'Miasta', 'icon' => 'fa fa-map-marker', 'url' => ['/city']],

                ],
            ]
        ) ?>

    </section>

</aside>