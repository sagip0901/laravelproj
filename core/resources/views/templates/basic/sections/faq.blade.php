@php
    $faqContent = getContent('faq.content', true);
    $faqElements = getContent('faq.element', orderById: true);
@endphp

<section class="faq py-70">
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title" s-break="-2">{{ __(@$faqContent->data_values->heading) }}</h2>
            <p class="section-heading__desc fs-18"> {{ __(@$faqContent->data_values->subheading) }}</p>
        </div>

        <div class="row gy-4 justify-content-center">
            <div class="accordion custom--accordion" id="faqAccordion1">
                @foreach ($faqElements as $item)
                    <div class="accordion-item">
                        <h6 class="accordion-header collapsed" id="heading{{ $item->id }}">
                            <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse{{ $item->id }}" type="button" aria-expanded="false" aria-controls="collapse{{ $item->id }}">
                                {{ __(@$item->data_values->question) }}
                            </button>
                        </h6>
                        <div class="accordion-collapse collapse" id="collapse{{ $item->id }}" data-bs-parent="#faqAccordion1" aria-labelledby="heading{{ $item->id }}">
                            <div class="accordion-body">
                                <p>{{ __(@$item->data_values->answer) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

@push('script')
    <script>
        // faq js
        $(".faq-single__header").each(function() {
            $(this).on("click", function() {
                $(this).siblings(".faq-single__content").slideToggle();
                $(this).parent(".faq-single").toggleClass("active");
            });
        });

        //faq - open by odd -even  items!
        window.addEventListener("DOMContentLoaded", () => {
            let faqElements = document.querySelectorAll(".accordion-item");
            let faqContainer = document.getElementById("faqAccordion1");
            let oddElement = "";
            let evenElement = "";

            if (
                faqContainer == undefined ||
                faqContainer.tagName != "DIV" ||
                typeof faqElements != "object"
            )
                return false;

            Array.from(faqElements).forEach(function(element, i) {
                if (i % 2 == 0) {
                    evenElement += element.outerHTML;
                } else {
                    oddElement += element.outerHTML;
                }
            });

            faqContainer.innerHTML = `
                      <div class="row gy-3">
                        <div class="col-lg-6">${evenElement}</div>
                        <div class="col-lg-6">${oddElement}</div>
                      </div>`;
        });
    </script>
@endpush
