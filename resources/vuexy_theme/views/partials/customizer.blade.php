{{-- BEGIN: Customizer --}}
<div class="customizer d-none d-md-block">

    <a class="customizer-toggle d-flex align-items-center justify-content-center" href="javascript:void(0);">
        <i class="spinner" data-feather="settings">
        </i>
    </a>

    <div class="customizer-content">
        <!-- Customizer header -->
        <div class="customizer-header px-2 pt-1 pb-0 position-relative">
            <h4 class="mb-0">Theme Customizer</h4>
            <p class="m-0">Customize & Preview in Real Time</p>

            <a class="customizer-close" href="javascript:void(0);"><i data-feather="x"></i></a>
        </div>

        <hr />

        <!-- Styling & Text Direction -->
        <div class="customizer-styling-direction px-2">
            <p class="font-weight-bold">Skin</p>
            <div class="d-flex">
                <div id="light-theme-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="skinlight" name="skinradio" class="custom-control-input layout-name"
                            checked data-layout="" />
                        <label class="custom-control-label" for="skinlight">Light</label>
                    </div>
                </div>
                <div id="bordered-theme-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="skinbordered" name="skinradio" class="custom-control-input layout-name"
                            data-layout="bordered-layout" />
                        <label class="custom-control-label" for="skinbordered">Bordered</label>
                    </div>
                </div>
                <div id="dark-theme-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="skindark" name="skinradio" class="custom-control-input layout-name"
                            data-layout="dark-layout" />
                        <label class="custom-control-label" for="skindark">Dark</label>
                    </div>
                </div>
            </div>
        </div>

        <hr />

        <!-- Menu -->
        <div class="customizer-menu px-2">
            <div id="customizer-menu-collapsible" class="d-flex">
                <p class="font-weight-bold mr-auto m-0">Collapsible</p>
                <div id="collapsible-button">
                    <div class="custom-control custom-control-primary custom-switch">
                        <input type="checkbox" class="custom-control-input" id="collapse-sidebar-switch"
                            data-status="off" />
                        <label class="custom-control-label" for="collapse-sidebar-switch"></label>
                    </div>
                </div>
            </div>
        </div>
        <hr />

        <!-- Layout Width -->
        <div class="customizer-footer px-2">
            <p class="font-weight-bold">Layout Width</p>
            <div class="d-flex">
                <div id="layout-full-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="layout-width-full" name="layoutWidth" class="custom-control-input"
                            checked />
                        <label class="custom-control-label" for="layout-width-full">Full Width</label>
                    </div>
                </div>
                <div id="layout-boxed-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="layout-width-boxed" name="layoutWidth" class="custom-control-input" />
                        <label class="custom-control-label" for="layout-width-boxed">Boxed</label>
                    </div>
                </div>
            </div>
        </div>
        <hr />

        <!-- Navbar -->
        <div class="customizer-navbar px-2">
            <div id="customizer-navbar-colors">
                <p class="font-weight-bold">Navbar Color</p>
                <ul class="list-inline unstyled-list">
                    <li class="color-box bg-white border selected" data-navbar-default="" data-color="bg-white">
                    </li>
                    <li class="color-box bg-primary" data-navbar-color="bg-primary" data-color="bg-primary">
                    </li>
                    <li class="color-box bg-secondary" data-navbar-color="bg-secondary" data-color="bg-secondary">
                    </li>
                    <li class="color-box bg-success" data-navbar-color="bg-success" data-color="bg-success">
                    </li>
                    <li class="color-box bg-danger" data-navbar-color="bg-danger" data-color="bg-danger">
                    </li>
                    <li class="color-box bg-info" data-navbar-color="bg-info" data-color="bg-info">
                    </li>
                    <li class="color-box bg-warning" data-navbar-color="bg-warning" data-color="bg-warning">
                    </li>
                    <li class="color-box bg-dark" data-navbar-color="bg-dark" data-color="bg-dark">
                    </li>
                </ul>
            </div>

            <p class="navbar-type-text font-weight-bold">Navbar Type</p>
            <div class="d-flex">
                <div id="nav-floating-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="nav-type-floating" name="navType" class="custom-control-input"
                            checked />
                        <label class="custom-control-label" for="nav-type-floating">Floating</label>
                    </div>
                </div>
                <div id="nav-sticky-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="nav-type-sticky" name="navType" class="custom-control-input" />
                        <label class="custom-control-label" for="nav-type-sticky">Sticky</label>
                    </div>
                </div>
                <div class="mr-1" id="nav-static-button">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="nav-type-static" name="navType" class="custom-control-input" />
                        <label class="custom-control-label" for="nav-type-static">Static</label>
                    </div>
                </div>
                <div class="mr-1" id="nav-hidden-button">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="nav-type-hidden" name="navType" class="custom-control-input" />
                        <label class="custom-control-label" for="nav-type-hidden">Hidden</label>
                    </div>
                </div>
            </div>
        </div>
        <hr />

        <!-- Footer -->
        <div class="customizer-footer px-2">
            <p class="font-weight-bold">Footer Type</p>
            <div class="d-flex">
                <div id="footer-sticky-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="footer-type-sticky" name="footerType" class="custom-control-input" />
                        <label class="custom-control-label" for="footer-type-sticky">Sticky</label>
                    </div>
                </div>
                <div id="footer-static-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="footer-type-static" name="footerType" class="custom-control-input"
                            checked />
                        <label class="custom-control-label" for="footer-type-static">Static</label>
                    </div>
                </div>
                <div id="footer-hidden-button" class="mr-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="footer-type-hidden" name="footerType" class="custom-control-input" />
                        <label class="custom-control-label" for="footer-type-hidden">Hidden</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- End: Customizer --}}
<script defer>
    const ready = ($) => {
        // events are wrappen in IIFEs in order to 
        // use block-scoped `running` variables
        // to prevent saving settings more than once

        const registerNavigationButtons = ($) => {
            (() => {
                let running = false;
                $('#nav-floating-button').click((e) => {
                    if (!running) {
                        running = true;
                    } else {
                        return;
                    }
                    $.post("{{ route('user.settings.store') }}", {
                        key: 'nav-layout',
                        value: 'floating',
                        "_token": "{{ csrf_token() }}",
                    }, () => (running = false));
                });
            })();

            (() => {
                let running = false;
                $('#nav-sticky-button').click((e) => {
                    if (!running) {
                        running = true;
                    } else {
                        return;
                    }
                    $.post("{{ route('user.settings.store') }}", {
                        key: 'nav-layout',
                        value: 'sticky',
                        "_token": "{{ csrf_token() }}",
                    }, () => (running = false));
                });
            })();

            (() => {
                let running = false;
                $('#nav-static-button').click((e) => {
                    if (!running) {
                        running = true;
                    } else {
                        return;
                    }
                    $.post("{{ route('user.settings.store') }}", {
                        key: 'nav-layout',
                        value: 'static',
                        "_token": "{{ csrf_token() }}",
                    }, () => (running = false));
                });
            })();

            (() => {
                let running = false;
                $('#nav-hidden-button').click((e) => {
                    if (!running) {
                        running = true;
                    } else {
                        return;
                    }
                    $.post("{{ route('user.settings.store') }}", {
                        key: 'nav-layout',
                        value: 'hidden',
                        "_token": "{{ csrf_token() }}",
                    }, () => (running = false));
                });
            })();
        }

        const registerThemeModes = ($) => {
            $('#theme-mode-button').click(() => {
                const mode = $('#theme-mode-button').attr('data-status') === 'dark' ? 'light' : 'dark';
                $(`#${mode}-theme-button`).click();
            });

            (() => {
                let running = false;
                $('#light-theme-button').click((e) => {
                    if (!running) {
                        running = true;
                    } else {
                        return;
                    }
                    $('#theme-mode-button').attr('data-status', 'light');
                    $('#theme-mode-button').html(
                        `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-moon ficon"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>`
                    );
                    $.post("{{ route('user.settings.store') }}", {
                        key: 'theme-mode',
                        value: 'light',
                        "_token": "{{ csrf_token() }}",
                    }, () => (running = false));
                });
            })();

            (() => {
                let running = false;
                $('#dark-theme-button').click((e) => {
                    if (!running) {
                        running = true;
                    } else {
                        return;
                    }
                    $('#theme-mode-button').attr('data-status', 'dark');
                    $('#theme-mode-button').html(
                        `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sun ficon"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>`
                    );
                    $.post("{{ route('user.settings.store') }}", {
                        key: 'theme-mode',
                        value: 'dark',
                        "_token": "{{ csrf_token() }}",
                    }, () => (running = false));
                });
            })();

            (() => {
                let running = false;
                $('#bordered-theme-button').click((e) => {
                    if (!running) {
                        running = true;
                    } else {
                        return;
                    }
                    $('#theme-mode-button').attr('data-status', 'light');
                    $('#theme-mode-button').html(
                        `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-moon ficon"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>`
                    );
                    $.post("{{ route('user.settings.store') }}", {
                        key: 'theme-mode',
                        value: 'bordered',
                        "_token": "{{ csrf_token() }}",
                    }, () => (running = false));
                });
            })();
        }

        const registerFooterButtons = ($) => {
            (() => {
                let running = false;
                $('#footer-sticky-button').click((e) => {
                    if (!running) {
                        running = true;
                    } else {
                        return;
                    }
                    $.post("{{ route('user.settings.store') }}", {
                        key: 'footer-layout',
                        value: 'sticky',
                        "_token": "{{ csrf_token() }}",
                    }, () => (running = false));
                });
            })();

            (() => {
                let running = false;
                $('#footer-static-button').click((e) => {
                    if (!running) {
                        running = true;
                    } else {
                        return;
                    }
                    $.post("{{ route('user.settings.store') }}", {
                        key: 'footer-layout',
                        value: 'static',
                        "_token": "{{ csrf_token() }}",
                    }, () => (running = false));
                });
            })();

            (() => {
                let running = false;
                $('#footer-hidden-button').click((e) => {
                    if (!running) {
                        running = true;
                    } else {
                        return;
                    }
                    $.post("{{ route('user.settings.store') }}", {
                        key: 'footer-layout',
                        value: 'hidden',
                        "_token": "{{ csrf_token() }}",
                    }, () => (running = false));
                });
            })();
        };

        const registerLayoutButtons = ($) => {
            (() => {
                let running = false;
                $('#layout-full-button').click(() => {
                    if (!running) {
                        running = true;
                    } else {
                        return;
                    }
                    $.post("{{ route('user.settings.store') }}", {
                        key: 'layout-mode',
                        value: 'full',
                        "_token": "{{ csrf_token() }}",
                    }, () => (running = false));
                });
            })();

            (() => {
                let running = false;
                $('#layout-boxed-button').click(() => {
                    if (!running) {
                        running = true;
                    } else {
                        return;
                    }
                    $.post("{{ route('user.settings.store') }}", {
                        key: 'layout-mode',
                        value: 'boxed',
                        "_token": "{{ csrf_token() }}",
                    }, () => (running = false));
                });
            })();
        };

        const registerSolos = ($) => {
            (() => {
                let running = false;
                $('#collapsible-button').click((e) => {
                    e.stopImmediatePropagation();
                    if (!running) {
                        running = true;
                    } else {
                        return;
                    }
                    const mode = $('#collapse-sidebar-switch').attr('data-status') === 'off' ?
                        'on' : 'off';
                    $('#collapse-sidebar-switch').attr('data-status', mode);
                    $.post("{{ route('user.settings.store') }}", {
                        key: 'collapsible-mode',
                        value: mode,
                        "_token": "{{ csrf_token() }}",
                    }, () => (running = false));
                });
            })();

            (() => {
                $('#sidebar-collapse-button').click(() => {
                    $('#collapsible-button').click();
                }); 
            })();

            (() => {
                let running = false;
                $('.color-box').click(function() {
                    if (!running) {
                        running = true;
                    } else {
                        return;
                    }
                    $.post("{{ route('user.settings.store') }}", {
                        key: 'navbar-color',
                        value: $(this).attr('data-color'),
                        "_token": "{{ csrf_token() }}",
                    }, () => (running = false));
                });
            })();
        }

        const sync = (done) => {
            $.get("{{ route('user.settings.index') }}", data => {
                data.forEach(({
                    key,
                    value
                }) => {
                    if (key === 'nav-layout') {
                        $(`#nav-type-${value}`).click();
                    }
                    if (key === 'footer-layout') {
                        $(`#footer-type-${value}`).click();
                    }
                    if (key === 'navbar-color') {
                        $(`.color-box.${value}`).click();
                    }
                    if (key === 'layout-mode') {
                        $(`#layout-width-${value}`).click();
                    }
                    if (key === 'theme-mode') {
                        $(`#skin${value}`).click();
                        if (value !== 'dark') {
                            $('#theme-mode-button').html(
                                `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-moon ficon"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>`
                            );
                            $('#theme-mode-button').attr('data-status', 'light');
                        }
                    }
                    if (key === 'collapsible-mode') {
                        if (value === 'on') {
                            $(`#collapse-sidebar-switch`).click();
                        }
                    }
                });
                done();
            }, 'json');
        };

        sync(() => {
            registerNavigationButtons($);
            registerThemeModes($);
            registerFooterButtons($);
            registerLayoutButtons($);
            registerSolos($);

            // remove loading screen
            $('#loading-content').remove();

            // show content
            $('#main-content-wrapper').removeClass('d-none');
        });
    };

    // polyfill wait for jQuery to load
    let handle;
    handle = setInterval(() => {
        if (window.$) {
            clearInterval(handle);
            window.$(document).ready(() => ready(window.$));
        }
    }, 1);

</script>