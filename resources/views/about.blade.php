@extends('layouts.app')

@section('title', 'Наши специалисты — Школа материнства «Рожаем вместе»')
@section('description', 'Елена Тимофеева, Вячеслав Тимофеев, Аделина и Екатерина — специалисты школы материнства «Рожаем вместе».')
@section('og_title', 'Наши специалисты — Школа материнства «Рожаем вместе»')
@section('og_description', 'Познакомьтесь со специалистами школы: подготовка к родам, семейная психология и бережное сопровождение в родах.')

@section('content')
<section class="min-h-[70vh] bg-gradient-hero pb-20 pt-44">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="section-eyebrow">Команда школы</span>
            <h1 class="section-heading mt-2">Наши специалисты</h1>
            <p class="section-subheading text-base leading-relaxed sm:text-lg">
                Познакомьтесь с людьми, которые готовят семьи к родам, помогают проживать перемены с большей опорой и сопровождают в важные моменты материнства.
            </p>
        </div>

        <div class="mt-12 space-y-6">
            <article class="overflow-hidden rounded-card border border-border-soft bg-bg-card shadow-card">
                <div class="grid lg:grid-cols-[18rem_minmax(0,1fr)]">
                    <div class="bg-bg-warm p-4 sm:p-6">
                        <img
                            src="{{ asset('images/site/elena-about.webp') }}"
                            alt="Елена Тимофеева, основатель и руководитель школы"
                            class="aspect-[4/5] w-full rounded-card object-cover object-top lg:sticky lg:top-48"
                            loading="eager"
                        >
                    </div>
                    <div class="p-6 sm:p-8 lg:p-10">
                        <span class="section-eyebrow">Основатель и руководитель школы</span>
                        <h2 class="mt-3 font-heading text-3xl font-bold text-text-heading sm:text-4xl">Елена Тимофеева</h2>

                        <p class="mt-6 leading-relaxed text-text-muted">
                            Меня зовут Елена, я многодетная мама, также основатель и руководитель школы материнства «Рожаем вместе»!
                        </p>

                        <p class="mt-5 font-semibold text-text-heading">
                            Напомню, кто я и почему мне можно доверять самое ценное:
                        </p>

                        <ul class="mt-5 grid gap-3 sm:grid-cols-2">
                            @foreach([
                                'Профессиональная доула и помощница в родах',
                                'Консультант по материнству и детскому здоровью',
                                'Инструктор по подготовке к родам',
                                'Фитнес-инструктор для беременных',
                                'Детский психолог-консультант',
                                'Специалист по коррекции детского сна',
                                'Консультант по прикорму',
                                'Перинатальный психолог',
                                'Детский нейропсихолог',
                            ] as $qualification)
                                <li class="flex gap-3 text-sm leading-relaxed text-text-muted sm:text-base">
                                    <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-gold/20 text-xs font-bold text-gold-dark">✓</span>
                                    <span>{{ $qualification }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <div class="mt-8 border-t border-border-soft pt-7">
                            <h3 class="font-heading text-xl font-bold text-text-heading">Профессиональные объединения</h3>
                            <ul class="mt-4 space-y-3">
                                <li class="flex gap-3 leading-relaxed text-text-muted">
                                    <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-gold/20 text-xs font-bold text-gold-dark">✓</span>
                                    <span>Член союза профессиональной поддержки материнства</span>
                                </li>
                                <li class="flex gap-3 leading-relaxed text-text-muted">
                                    <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-gold/20 text-xs font-bold text-gold-dark">✓</span>
                                    <span>Член ассоциации профессиональных доул</span>
                                </li>
                            </ul>
                        </div>

                        <p class="mt-8 border-t border-border-soft pt-7 leading-relaxed text-text-muted">
                            А также сертифицированный специалист: расслабление мексиканским ребозо, прошла курс «Остеопатический подход помощи беременной и рожающей женщине», тейпирование в первые часы после родов.
                        </p>

                        <p class="mt-5 font-medium leading-relaxed text-text-heading">
                            Я объединила все свои знания, чтобы ваше материнство начиналось с лёгкостью, спокойствием и радостью.
                        </p>
                    </div>
                </div>
            </article>

            <article class="overflow-hidden rounded-card border border-border-soft bg-bg-card shadow-card">
                <div class="grid lg:grid-cols-[18rem_minmax(0,1fr)]">
                    <div class="bg-bg-warm p-4 sm:p-6">
                        <img
                            src="{{ asset('images/site/vyacheslav-specialist.webp') }}"
                            alt="Вячеслав Тимофеев, семейный психолог"
                            class="aspect-[4/5] w-full rounded-card object-cover object-top lg:sticky lg:top-48"
                            loading="lazy"
                        >
                    </div>
                    <div class="p-6 sm:p-8 lg:p-10">
                        <span class="section-eyebrow">Семейная психология</span>
                        <h2 class="mt-3 font-heading text-3xl font-bold text-text-heading sm:text-4xl">Вячеслав Тимофеев</h2>
                        <p class="mt-5 font-medium text-text-heading">Многодетный отец</p>
                        <p class="mt-2 font-semibold text-accent">Семейный психолог</p>

                        <section class="mt-8">
                            <h3 class="font-heading text-2xl font-bold text-text-heading">Направления работы</h3>
                            <ul class="mt-5 space-y-4">
                                <li class="leading-relaxed text-text-muted"><strong class="text-text-heading">Семейное и супружеское консультирование:</strong> Помощь в преодолении кризисов, разрешении конфликтов и налаживании коммуникации в паре.</li>
                                <li class="leading-relaxed text-text-muted"><strong class="text-text-heading">Индивидуальная терапия:</strong> Работа с личными запросами — от выгорания и неуверенности до поиска себя и преодоления последствий внутренних конфликтов (например, тревожности).</li>
                                <li class="leading-relaxed text-text-muted"><strong class="text-text-heading">Детско-родительские отношения:</strong> Помощь семьям в понимании потребностей детей, выстраивании доверительных отношений и прохождении возрастных кризисов.</li>
                            </ul>
                        </section>

                        <p class="mt-8 border-t border-border-soft pt-7 leading-relaxed text-text-muted">
                            Моя основная задача в перинатальный период — не просто «подготовить мужчину к присутствию на родах», а превратить его из испуганного наблюдателя в уверенного помощника и эмоциональную опору для партнёрши.
                        </p>

                        <p class="mt-5 font-medium leading-relaxed text-text-heading">
                            Работа с психологом охватывает три ключевых этапа: период до родов, сами роды и послеродовое восстановление.
                        </p>

                        <section class="mt-8 border-t border-border-soft pt-7">
                            <h3 class="font-heading text-2xl font-bold text-text-heading">👨‍🍼 Этап 1. Подготовка к партнёрским родам</h3>
                            <p class="mt-4 leading-relaxed text-text-muted">
                                Это не просто медицинская формальность, а глубокая психологическая перестройка. Быть «партнёром» — значит участвовать, а не наблюдать.
                            </p>
                            <ul class="mt-5 space-y-4">
                                <li class="leading-relaxed text-text-muted"><strong class="text-text-heading">Информированность и спокойствие:</strong> Мужчина, знающий этапы родов и возможные сценарии, гораздо спокойнее. Это помогает ему правильно понимать действия врачей и не паниковать.</li>
                                <li class="leading-relaxed text-text-muted"><strong class="text-text-heading">Работа с мотивацией и страхами:</strong> Психолог помогает проверить мотивы (решение должно быть добровольным), проработать страхи перед кровью, болью или собственной беспомощностью.</li>
                            </ul>
                        </section>

                        <section class="mt-8 border-t border-border-soft pt-7">
                            <h3 class="font-heading text-2xl font-bold text-text-heading">🤱 Этап 2. Поддержка в родах</h3>
                            <p class="mt-4 leading-relaxed text-text-muted">
                                В момент родов задача партнёра — создать для женщины безопасное пространство и взять на себя «контроль над внешним миром». Я помогаю мужчине понять, что в этом процессе он не «зритель», а «буфер» между роженицей и внешней суетой, позволяя ей полностью сосредоточиться на главной задаче.
                            </p>
                        </section>

                        <section class="mt-8 border-t border-border-soft pt-7">
                            <h3 class="font-heading text-2xl font-bold text-text-heading">👨‍👧‍👦 Этап 3. Психологическая помощь после родов</h3>
                            <p class="mt-4 leading-relaxed text-text-muted">
                                Вопреки стереотипам, это критически важное время не только для мамы, но и для папы.
                            </p>
                            <ul class="mt-5 space-y-4">
                                <li class="leading-relaxed text-text-muted"><strong class="text-text-heading">Профилактика депрессии у отца:</strong> Послеродовая депрессия встречается у каждого десятого мужчины. Психолог помогает справиться с выгоранием, недосыпом, чувством одиночества и финансовым давлением.</li>
                                <li class="leading-relaxed text-text-muted"><strong class="text-text-heading">Включение в уход:</strong> Помогаю наладить контакт отца с ребёнком. Его роль — активный участник. Тактильный контакт, купание и укладывание помогают запустить «отцовский инстинкт».</li>
                                <li class="leading-relaxed text-text-muted"><strong class="text-text-heading">Роль «буфера»:</strong> После родов отцу важно защищать маму и малыша от внешних советчиков и стресса, создавая им «тихую гавань» для восстановления.</li>
                            </ul>
                        </section>

                        <section class="mt-8 border-t border-border-soft pt-7">
                            <h3 class="font-heading text-2xl font-bold text-text-heading">💡 Когда помощь психолога особенно нужна?</h3>
                            <ul class="mt-5 space-y-3">
                                <li class="leading-relaxed text-text-muted">· Если мужчина не уверен, что хочет присутствовать на родах.</li>
                                <li class="leading-relaxed text-text-muted">· Если в паре есть конфликты или напряжение.</li>
                                <li class="leading-relaxed text-text-muted">· Если мужчина склонен к тревожности, панике или падает в обморок при виде крови.</li>
                                <li class="leading-relaxed text-text-muted">· Если мама испытывает послеродовую депрессию или тревогу — это напрямую влияет на психологическое состояние отца.</li>
                            </ul>
                        </section>

                        <p class="mt-8 border-t border-border-soft pt-7 font-medium leading-relaxed text-text-heading">
                            Я не даю готовых решений, а помогаю паре найти собственный путь. Создаю безопасное пространство для диалога, чтобы мужчина смог обрести уверенность в своей новой роли, а женщина — чувствовать себя защищённой.
                        </p>
                    </div>
                </div>
            </article>

            <article class="overflow-hidden rounded-card border border-border-soft bg-bg-card shadow-card">
                <div class="grid lg:grid-cols-[18rem_minmax(0,1fr)]">
                    <div class="bg-bg-warm p-4 sm:p-6">
                        <img
                            src="{{ asset('images/site/adelina-doula.jpg') }}"
                            alt="Аделина, доула школы"
                            class="aspect-[4/5] w-full rounded-card object-cover object-center lg:sticky lg:top-48"
                            loading="lazy"
                        >
                    </div>
                    <div class="p-6 sm:p-8 lg:p-10">
                        <span class="section-eyebrow">Доула школы</span>
                        <h2 class="mt-3 font-heading text-3xl font-bold text-text-heading sm:text-4xl">Аделина</h2>
                        <p class="mt-6 max-w-3xl leading-relaxed text-text-muted">
                            Меня зовут Аделина. Я мама погодок и доула по призванию души. Пройдя собственный путь материнства, я поняла, что поддержка женщины в родах — моё истинное дело. Моя цель — помочь вам чувствовать себя защищённо, уверенно и спокойно в этот важный момент.
                        </p>
                    </div>
                </div>
            </article>

            <article class="overflow-hidden rounded-card border border-border-soft bg-bg-card shadow-card">
                <div class="grid lg:grid-cols-[18rem_minmax(0,1fr)]">
                    <div class="bg-bg-warm p-4 sm:p-6">
                        <img
                            src="{{ asset('images/site/ekaterina-specialist.webp') }}"
                            alt="Екатерина, доула школы"
                            class="aspect-[4/5] w-full rounded-card object-cover object-top lg:sticky lg:top-48"
                            loading="lazy"
                        >
                    </div>
                    <div class="p-6 sm:p-8 lg:p-10">
                        <span class="section-eyebrow">Доула школы</span>
                        <h2 class="mt-3 font-heading text-3xl font-bold text-text-heading sm:text-4xl">Екатерина</h2>
                        <p class="mt-6 max-w-3xl leading-relaxed text-text-muted">
                            Я рядом с женщиной в один из самых важных моментов её жизни — во время родов. Сопровождаю этот путь бережно, без давления и лишних ожиданий. Помогаю создать спокойную атмосферу, поддерживаю дыханием, удобными положениями тела и внимательным присутствием.
                        </p>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
@endsection
