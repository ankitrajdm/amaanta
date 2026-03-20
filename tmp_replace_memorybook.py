from pathlib import Path
path = Path('resources/views/pages/memorybook.blade.php')
text = path.read_text(encoding='utf-8')
start = text.find('\n   <!-- Team/Services -->')
if start == -1:
    start = text.find('<!-- Team/Services -->')
if start == -1:
    raise RuntimeError('start marker not found')
end = text.find('\n    @include(\'partials.footer\')', start)
if end == -1:
    raise RuntimeError('end marker not found')
old = text[start:end]
new = "\n    <!-- Services -->\n    <section class=\"services section-padding\">\n        <div class=\"container\">\n            <div class=\"row\">\n                <div class=\"col-md-5 mb-30\">\n                    <div class=\"section-subtitle\">{!! $sections['services']->heading ?? 'The experience' !!}</div>\n                    <div class=\"section-title\">{!! $sections['services']->content ?? 'Explore <span>Services</span>' !!}</div>\n                </div>\n            </div>\n            <div class=\"row\">\n                <div class=\"col-md-12\">\n                    <div class=\"owl-carousel owl-theme\">\n                        @foreach($services as $service)\n                        <div class=\"item\">\n                            <div class=\"position-re o-hidden\"> <img src=\"{{ $service->image ?? '/assets/img/services/default.jpg' }}\" alt=\"\"> </div>\n                            <div class=\"con\">\n                                <h5><a href=\"{{ route('services.detail', $service->slug) }}\">{{ $service->title }} <span>{{ $service->slug }}</span></a> </h5>\n                                <div class=\"line\"></div>\n                                <div class=\"row facilities\">\n                                    <div class=\"col-md-12 text-right\">\n                                        <div class=\"permalink\"><a href=\"{{ route('services.detail', $service->slug) }}\">Explore <i class=\"ti-arrow-right\"></i></a></div>\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                        @endforeach\n                    </div>\n                </div>\n            </div>\n        </div>\n    </section>\n\n" 
text = text[:start] + new + text[end:]
path.write_text(text, encoding='utf-8')
print('updated')
