@extends('frontend.layouts.layoutfrontend')
@section(section: 'contentlandinpage')
<main>
<section class="py-xl-8 py-6">
    <div class="container py-xl-6">
        <div class="row align-items-center gy-6 gy-xl-0">
            <div class="col-lg-5 col-xxl-5 col-12">
                <div class="d-flex flex-column gap-5">
                    <div class="d-flex flex-row gap-2 align-items-center">
                        <span>🌱</span>
                        <span class="text-primary fw-semibold">
                            <span>Commencez votre voyage vers un jardin urbain durable</span>
                        </span>
                    </div>
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex flex-column gap-2">
                            <h1 class="mb-0 display-2 fw-bolder">La plateforme n°1 pour l'agriculture urbaine</h1>
                            <p class="mb-0">Des ressources et conseils pour aider les citadins à créer des jardins durables et partager des ressources.</p>
                        </div>
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                            <li class="d-flex flex-row gap-2">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                    </svg>
                                </span>
                                <span>Conseils d'experts</span>
                            </li>
                            <li class="d-flex flex-row gap-2">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                    </svg>
                                </span>
                                <span>Jardinage flexible en ville</span>
                            </li>
                            <li class="d-flex flex-row gap-2">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                    </svg>
                                </span>
                                <span>Communauté solidaire</span>
                            </li>
                        </ul>
                    </div>
                    <div class="d-grid d-md-flex flex-row gap-2">
                        <a href="#!" class="btn btn-primary btn-lg">Rejoignez gratuitement</a>
                        <a href="#!" class="btn btn-outline-secondary btn-lg">Explorer les Ressources</a>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 offset-xxl-1 col-lg-7 col-12">
                <div class="row gx-0 gy-4 gy-lg-0">
                    <div class="col-md-6 flex-column justify-content-start align-items-center d-none d-md-flex">
                        <div class="position-relative me-n7">
                            <div class="position-absolute bottom-25 start-0 ms-n8 end-0 d-flex flex-column align-items-start">
                                <div class="bg-white rounded-pill py-2 px-3 shadow mb-2 d-inline-block">
                                    <svg width="24" height="24" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M23.9688 3.0378H8.29689C7.3189 3.0378 6.38097 3.4263 5.68942 4.11784C4.99788 4.80939 4.60938 5.74732 4.60938 6.72531V26.0848C4.60938 26.3293 4.7065 26.5638 4.87939 26.7366C5.05227 26.9095 5.28676 27.0066 5.53125 27.0066H22.1251C22.3696 27.0066 22.6041 26.9095 22.7769 26.7366C22.9498 26.5638 23.047 26.3293 23.047 26.0848C23.047 25.8403 22.9498 25.6058 22.7769 25.4329C22.6041 25.26 22.3696 25.1629 22.1251 25.1629H6.45313C6.45313 24.6739 6.64739 24.2049 6.99316 23.8592C7.33893 23.5134 7.8079 23.3191 8.29689 23.3191H23.9688C24.2133 23.3191 24.4478 23.222 24.6207 23.0491C24.7936 22.8762 24.8907 22.6418 24.8907 22.3973V3.95967C24.8907 3.71518 24.7936 3.48069 24.6207 3.30781C24.4478 3.13492 24.2133 3.0378 23.9688 3.0378ZM13.8282 4.88155H19.3594V13.1785L17.1458 11.5191C16.9862 11.3994 16.7921 11.3347 16.5927 11.3347C16.3932 11.3347 16.1991 11.3994 16.0395 11.5191L13.8282 13.1785V4.88155ZM23.047 21.4754H8.29689C7.64944 21.4745 7.0133 21.6451 6.45313 21.9697V6.72531C6.45313 6.23632 6.64739 5.76735 6.99316 5.42158C7.33893 5.07581 7.8079 4.88155 8.29689 4.88155H11.9844V15.0222C11.9844 15.1934 12.0321 15.3612 12.1221 15.5069C12.2121 15.6525 12.3409 15.7702 12.494 15.8468C12.6471 15.9233 12.8186 15.9558 12.9891 15.9404C13.1596 15.925 13.3225 15.8624 13.4594 15.7597L16.5938 13.4089L19.7293 15.7597C19.8886 15.8792 20.0822 15.9439 20.2813 15.9441C20.5258 15.9441 20.7603 15.847 20.9332 15.6741C21.1061 15.5012 21.2032 15.2667 21.2032 15.0222V4.88155H23.047V21.4754Z"
                                            fill="#F59E0B" />
                                    </svg>
                                    <span class="text-dark fw-semibold">50+ Projets communautaires</span>
                                </div>
                                <div class="bg-white rounded-pill py-2 px-3 shadow">
                                    <svg width="24" height="25" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18.9492 12.9114L13.4179 9.22386C13.2791 9.13121 13.1176 9.078 12.9509 9.06992C12.7842 9.06185 12.6184 9.0992 12.4712 9.17799C12.324 9.25678 12.201 9.37406 12.1153 9.5173C12.0295 9.66055 11.9843 9.82438 11.9844 9.99132V17.3664C11.9843 17.5333 12.0295 17.6971 12.1153 17.8404C12.201 17.9836 12.324 18.1009 12.4712 18.1797C12.6184 18.2585 12.7842 18.2958 12.9509 18.2878C13.1176 18.2797 13.2791 18.2265 13.4179 18.1338L18.9492 14.4463C19.0757 14.3622 19.1794 14.2481 19.2511 14.1142C19.3228 13.9803 19.3603 13.8307 19.3603 13.6788C19.3603 13.5269 19.3228 13.3774 19.2511 13.2435C19.1794 13.1096 19.0757 12.9955 18.9492 12.9114ZM13.8282 15.6436V11.7198L16.7759 13.6788L13.8282 15.6436ZM24.8907 5.38193H4.60938C4.12039 5.38193 3.65142 5.57618 3.30565 5.92195C2.95988 6.26772 2.76563 6.73669 2.76562 7.22569V20.132C2.76563 20.621 2.95988 21.09 3.30565 21.4357C3.65142 21.7815 4.12039 21.9757 4.60938 21.9757H24.8907C25.3797 21.9757 25.8487 21.7815 26.1945 21.4357C26.5402 21.09 26.7345 20.621 26.7345 20.132V7.22569C26.7345 6.73669 26.5402 6.26772 26.1945 5.92195C25.8487 5.57618 25.3797 5.38193 24.8907 5.38193ZM24.8907 20.132H4.60938V7.22569H24.8907V20.132ZM26.7345 24.7414C26.7345 24.9859 26.6374 25.2204 26.4645 25.3933C26.2916 25.5661 26.0571 25.6633 25.8126 25.6633H3.6875C3.44301 25.6633 3.20852 25.5661 3.03564 25.3933C2.86275 25.2204 2.76563 24.9859 2.76562 24.7414C2.76562 24.4969 2.86275 24.2624 3.03564 24.0895C3.20852 23.9166 3.44301 23.8195 3.6875 23.8195H25.8126C26.0571 23.8195 26.2916 23.9166 26.4645 24.0895C26.6374 24.2624 26.7345 24.4969 26.7345 24.7414Z"
                                            fill="#E53E3E" />
                                    </svg>
                                    <span class="text-dark fw-semibold">Projets en ligne</span>
                                </div>
                            </div>
                            <svg width="205" height="189" viewBox="0 0 205 189" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.0391235 179.983C0.0391235 80.8399 80.4107 0.468323 179.554 0.468323H189.034C197.318 0.468323 204.033 7.18386 204.033 15.4679V166.407C204.033 178.626 194.127 188.532 181.908 188.532H8.58745C3.86634 188.532 0.0391235 184.704 0.0391235 179.983Z"
                                    fill="#139A74" />
                            </svg>
                        </div>
                    </div>
                    <div class="col-md-6 mt-8 mt-md-0">
                        <div class="bg-warning d-flex justify-content-center rounded-4 position-relative" style="padding-bottom: 150px; padding-top: 100px">
                            <img src="assets/images/landing-immigration/little-farmer.png" alt="Jardin Urbain" class="position-absolute bottom-0 me-8" />
                        </div>
                    </div>
                    <div class="col-md-6 flex-column justify-content-end d-none d-md-flex">
                        <div class="bg-primary d-flex justify-content-center rounded-4 position-relative mx-5" style="padding-bottom: 150px; padding-top: 100px">
                            <img src="assets/images/landing-immigration/happy-young-man-gardener-portrait.png" alt="Jardin Urbain" class="position-absolute bottom-0" />
                        </div>
                    </div>
                    <div class="col-md-6 d-none d-md-block">
                        <div class="position-relative mt-5">
                            <svg width="204" height="189" viewBox="0 0 204 189" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M203.994 9.01663C203.994 108.16 123.622 188.532 24.4789 188.532H14.9995C6.71548 188.532 -3.05176e-05 181.816 -3.05176e-05 173.532V22.5934C-3.05176e-05 10.374 9.90572 0.468292 22.1251 0.468292H195.446C200.167 0.468292 203.994 4.29552 203.994 9.01663Z"
                                    fill="#EF8E70" />
                            </svg>
                            <div class="bg-white rounded-4 p-3 position-absolute bottom-10 start-10 mb-3 shadow">
                                <div class="avatar-group mb-2">
                                    <span class="avatar avatar-md">
                                        <!-- avatar  -->
                                        <img alt="avatar" src="assets/images/avatar/avatar-1.jpg" class="rounded-circle" />
                                    </span>
                                    <!-- avatar  -->
                                    <span class="avatar avatar-md">
                                        <img alt="avatar" src="assets/images/avatar/avatar-2.jpg" class="rounded-circle" />
                                    </span>
                                    <!-- avatar  -->
                                    <span class="avatar avatar-md">
                                        <img alt="avatar" src="assets/images/avatar/avatar-3.jpg" class="rounded-circle" />
                                    </span>
                                    <!-- avatar  -->
                                    <span class="avatar avatar-md">
                                        <img alt="avatar" src="assets/images/avatar/avatar-4.jpg" class="rounded-circle" />
                                    </span>
                                </div>
                                <div class="text-dark fw-bold fs-4">12,524+</div>
                                <div class="text-gray-500">Jardiniers engagés avec nous</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <section class="py-lg-8 py-5">
        <div class="container px-lg-6 my-lg-8">
            <div class="row align-items-center gy-4 gy-lg-0">
                <div class="col-lg-5">
                    <div class="row align-items-end g-3 mb-3">
                        <div class="col-6">
                            <img src="../../assets/images/landing-immigration/about-img-1.jpg" alt="" class="img-fluid rounded-3 w-100" />
                        </div>
                        <div class="col-6">
                            <img src="../../assets/images/landing-immigration/SDG.jpg" alt="" class="img-fluid rounded-3 w-100" />
                        </div>
                    </div>
                    <img src="../../assets/images/landing-immigration/about-img-3.jpg" alt="" class="img-fluid rounded-3 w-100" />
                </div>
                <div class="col-lg-6 col-12 ms-lg-8">
                    <div class="mb-5">
                        <span class="fw-semibold text-success">About - Your Trusted Partner</span>
                        <h2 class="h1 my-3">Cultivating Community Excellence with Green Link </h2>
                        <p class="mb-0">
                            At
                            <span class="mb-0 text-secondary">Green</span>
                            <span class="mb-0 text-success">
                                <span>Link</span>
                            </span> we are committed to empowering communities by fostering collaboration and providing resources to help you cultivate thriving gardens. Join us and embark on a journey to sustainable gardening excellence, with expert resources and personalized support.
                        </p>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    opacity="0.2"
                                    d="M16.5 12.3037C16.5 13.1937 16.2361 14.0638 15.7416 14.8038C15.2471 15.5438 14.5443 16.1206 13.7221 16.4612C12.8998 16.8018 11.995 16.8909 11.1221 16.7172C10.2492 16.5436 9.44736 16.115 8.81802 15.4857C8.18869 14.8564 7.7601 14.0545 7.58647 13.1816C7.41283 12.3087 7.50195 11.4039 7.84254 10.5816C8.18314 9.75937 8.75991 9.05656 9.49994 8.5621C10.24 8.06763 11.11 7.80371 12 7.80371C13.1935 7.80371 14.3381 8.27782 15.182 9.12173C16.0259 9.96564 16.5 11.1102 16.5 12.3037Z"
                                    fill=" #008000 " />
                                <path
                                    d="M20.8004 8.09997C21.8412 10.2767 22.0387 12.7617 21.355 15.0755C20.6713 17.3893 19.1547 19.3678 17.098 20.6292C15.0413 21.8906 12.5902 22.3454 10.2179 21.9059C7.84557 21.4664 5.72013 20.1637 4.25179 18.2492C2.78344 16.3348 2.0763 13.9443 2.26682 11.5391C2.45735 9.13396 3.53204 6.88461 5.28348 5.22522C7.03492 3.56583 9.33895 2.61402 11.7509 2.55349C14.1628 2.49296 16.5117 3.32801 18.3442 4.89747L20.4695 2.77122C20.6102 2.63049 20.8011 2.55143 21.0001 2.55143C21.1991 2.55143 21.39 2.63049 21.5307 2.77122C21.6715 2.91195 21.7505 3.10282 21.7505 3.30184C21.7505 3.50087 21.6715 3.69174 21.5307 3.83247L12.5307 12.8325C12.39 12.9732 12.1991 13.0523 12.0001 13.0523C11.8011 13.0523 11.6102 12.9732 11.4695 12.8325C11.3288 12.6917 11.2497 12.5009 11.2497 12.3018C11.2497 12.1028 11.3288 11.9119 11.4695 11.7712L14.0682 9.17247C13.3639 8.70668 12.5231 8.49221 11.6817 8.56379C10.8404 8.63538 10.0478 8.98881 9.43231 9.56689C8.81683 10.145 8.41446 10.9139 8.29034 11.7491C8.16622 12.5843 8.32762 13.437 8.7484 14.169C9.16919 14.9011 9.82473 15.4697 10.6089 15.7829C11.3931 16.096 12.26 16.1354 13.0693 15.8945C13.8786 15.6536 14.5829 15.1467 15.0683 14.4557C15.5536 13.7647 15.7915 12.9302 15.7435 12.0872C15.738 11.9887 15.7519 11.89 15.7845 11.7969C15.8171 11.7038 15.8677 11.618 15.9334 11.5445C15.9991 11.4709 16.0787 11.411 16.1676 11.3682C16.2564 11.3254 16.3529 11.3005 16.4514 11.295C16.6503 11.2838 16.8455 11.3521 16.994 11.4848C17.0676 11.5505 17.1275 11.6301 17.1703 11.719C17.2131 11.8079 17.238 11.9043 17.2435 12.0028C17.3119 13.196 16.9711 14.3769 16.2774 15.3501C15.5838 16.3234 14.5788 17.0309 13.4285 17.3556C12.2783 17.6804 11.0517 17.6029 9.95148 17.1361C8.85123 16.6692 7.94322 15.8409 7.3775 14.7881C6.81178 13.7353 6.62223 12.521 6.84017 11.3458C7.05811 10.1707 7.67049 9.10504 8.57611 8.32509C9.48173 7.54514 10.6264 7.09753 11.8208 7.05626C13.0153 7.01499 14.1881 7.38251 15.1454 8.09809L17.2782 5.96528C15.7152 4.66759 13.7279 3.99312 11.6979 4.07141C9.66793 4.14971 7.73844 4.97524 6.28003 6.38947C4.82163 7.80369 3.93715 9.70688 3.79646 11.7335C3.65578 13.7601 4.26881 15.7673 5.51782 17.3694C6.76683 18.9716 8.56375 20.0558 10.5634 20.4138C12.5631 20.7719 14.6246 20.3785 16.3519 19.3092C18.0792 18.2399 19.3506 16.5701 19.9218 14.6206C20.493 12.6711 20.3238 10.5792 19.4467 8.74684C19.3609 8.56733 19.3499 8.36108 19.4162 8.17349C19.4825 7.98589 19.6206 7.83231 19.8001 7.74653C19.9796 7.66075 20.1859 7.6498 20.3735 7.71608C20.5611 7.78236 20.7146 7.92045 20.8004 8.09997Z"
                                    fill=" #008000 " />
                            </svg>

                            <h3 class="mb-0">Our Mission</h3>
                        </div>
                        <p class="mb-0">
                            At
                            <span class="mb-0 text-secondary">Green</span>
                            <span class="mb-0 text-success">
                                <span>Link</span>
                            </span>
                            our mission is to empower gardeners and communities to reach their full potential by providing comprehensive resources, tools, and support for every stage of their gardening journey.
                        </p>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    opacity="0.2"
                                    d="M12 5.55371C4.5 5.55371 1.5 12.3037 1.5 12.3037C1.5 12.3037 4.5 19.0537 12 19.0537C19.5 19.0537 22.5 12.3037 22.5 12.3037C22.5 12.3037 19.5 5.55371 12 5.55371ZM12 16.0537C11.2583 16.0537 10.5333 15.8338 9.91661 15.4217C9.29993 15.0097 8.81928 14.424 8.53545 13.7388C8.25162 13.0536 8.17736 12.2996 8.32205 11.5721C8.46675 10.8447 8.8239 10.1765 9.34835 9.65206C9.8728 9.12761 10.541 8.77046 11.2684 8.62577C11.9958 8.48107 12.7498 8.55533 13.4351 8.83916C14.1203 9.12299 14.706 9.60364 15.118 10.2203C15.5301 10.837 15.75 11.562 15.75 12.3037C15.75 13.2983 15.3549 14.2521 14.6517 14.9554C13.9484 15.6586 12.9946 16.0537 12 16.0537Z"
                                    fill=" #008000 " />
                                <path
                                    d="M23.1853 12C23.1525 11.9259 22.3584 10.1643 20.5931 8.39902C18.2409 6.04684 15.27 4.80371 12 4.80371C8.72999 4.80371 5.75905 6.04684 3.40687 8.39902C1.64155 10.1643 0.843741 11.9287 0.814679 12C0.772035 12.0959 0.75 12.1997 0.75 12.3046C0.75 12.4096 0.772035 12.5134 0.814679 12.6093C0.847491 12.6834 1.64155 14.444 3.40687 16.2093C5.75905 18.5606 8.72999 19.8037 12 19.8037C15.27 19.8037 18.2409 18.5606 20.5931 16.2093C22.3584 14.444 23.1525 12.6834 23.1853 12.6093C23.2279 12.5134 23.25 12.4096 23.25 12.3046C23.25 12.1997 23.2279 12.0959 23.1853 12ZM12 18.3037C9.11437 18.3037 6.59343 17.2546 4.50655 15.1865C3.65028 14.335 2.92179 13.364 2.34374 12.3037C2.92164 11.2433 3.65014 10.2723 4.50655 9.4209C6.59343 7.35277 9.11437 6.30371 12 6.30371C14.8856 6.30371 17.4066 7.35277 19.4934 9.4209C20.3514 10.2721 21.0815 11.2431 21.6609 12.3037C20.985 13.5656 18.0403 18.3037 12 18.3037ZM12 7.80371C11.11 7.80371 10.2399 8.06763 9.49993 8.5621C8.7599 9.05656 8.18313 9.75937 7.84253 10.5816C7.50194 11.4039 7.41282 12.3087 7.58646 13.1816C7.76009 14.0545 8.18867 14.8564 8.81801 15.4857C9.44735 16.115 10.2492 16.5436 11.1221 16.7172C11.995 16.8909 12.8998 16.8018 13.7221 16.4612C14.5443 16.1206 15.2471 15.5438 15.7416 14.8038C16.2361 14.0638 16.5 13.1937 16.5 12.3037C16.4988 11.1106 16.0242 9.96675 15.1806 9.1231C14.337 8.27946 13.1931 7.80495 12 7.80371ZM12 15.3037C11.4066 15.3037 10.8266 15.1278 10.3333 14.7981C9.83993 14.4685 9.45542 13.9999 9.22835 13.4518C9.00129 12.9036 8.94188 12.3004 9.05764 11.7184C9.17339 11.1365 9.45911 10.6019 9.87867 10.1824C10.2982 9.76283 10.8328 9.47711 11.4147 9.36135C11.9967 9.2456 12.5999 9.30501 13.148 9.53207C13.6962 9.75913 14.1648 10.1437 14.4944 10.637C14.824 11.1303 15 11.7104 15 12.3037C15 13.0994 14.6839 13.8624 14.1213 14.425C13.5587 14.9876 12.7956 15.3037 12 15.3037Z"
                                    fill=" #008000 " />
                            </svg>

                            <h3 class="mb-0">Our Vision</h3>
                        </div>

                        <p class="mb-0">
                            At
                            <span class="mb-0 text-secondary">Green</span>
                            <span class="mb-0 text-success">
                                <span>Link</span>
                            </span>
                            our mission is to empower gardeners and communities to reach their full potential by providing comprehensive resources, tools, and support for every stage of their gardening journey. We are committed to encouraging sustainable practices that align with the United Nations' Sustainable Development Goals (SDGs), promoting environmental stewardship, food security, and stronger, greener communities.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-8 bg-light">
        <div class="container">
          <div class="row gy-4 gy-xl-0">
            <!-- <div class="col-xl-4 col-lg-6 col-12">
              <div class="bg-dark px-4 pt-4 rounded-3 position-relative d-flex flex-column justify-content-center">
                <img src="../../assets/images/landing-immigration/beautiful-woman-works-garden.jpg" alt="" class="img-fluid" />
                <div class="position-absolute top-50 start-50 mx-n4">
                  <a class="glightbox icon-shape rounded-circle icon-xl pulser" href="https://www.youtube.com/watch?v=Nfzi7034Kbg">
                    <i class="fe fe-play"></i>
                  </a>
                </div>
                <div class="position-absolute bottom-0 mb-6 start-0 end-0 ps-4">
                  <div class="bg-dark d-inline-block p-2 px-3 text-white fw-semibold">Shawn Beltran</div>
                  <div class="bg-white d-inline-block p-2 px-3 text-dark fw-semibold ms-5">
                    <span class="text-gray-500">Gardening Tips</span>
                    <span class="mx-2">Canada</span>
                    <svg width="24" height="24" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0_8060_1993)">
                        <path d="M36 72C55.8823 72 72 55.8823 72 36C72 16.1177 55.8823 0 36 0C16.1177 0 0 16.1177 0 36C0 55.8823 16.1177 72 36 72Z" fill="#F0F0F0"></path>
                        <path d="M72.0027 36.003C72.0027 21.7304 63.6966 9.39819 51.6548 3.5752V68.4307C63.6966 62.6079 72.0027 50.2756 72.0027 36.003Z" fill="#D80027"></path>
                        <path d="M0.00146484 36.0011C0.00146484 50.2737 8.30748 62.6059 20.3493 68.4289V3.57324C8.30748 9.39624 0.00146484 21.7285 0.00146484 36.0011Z" fill="#D80027"></path>
                        <path
                          d="M42.2626 40.6985L48.5233 37.5681L45.393 36.0029V32.8724L39.1321 36.0029L42.2626 29.742H39.1321L36.0017 25.0464L32.8712 29.742H29.7407L32.8712 36.0029L26.6103 32.8724V36.0029L23.48 37.5681L29.7407 40.6985L28.1756 43.829H34.4365V48.5246H37.5668V43.829H43.8277L42.2626 40.6985Z"
                          fill="#D80027"></path>
                      </g>
                      <defs>
                        <clipPath id="clip0_8060_1993">
                          <rect width="72" height="72" fill="white"></rect>
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                </div>
              </div>
            </div> -->
            <div class="col-xl-4 col-lg-6 col-12">
  <div class="bg-dark px-4 pt-4 rounded-3 position-relative d-flex flex-column justify-content-center">
    <img src="../../assets/images/landing-immigration/gard.png" alt="" class="img-fluid w-100 h-100" />
    <div class="position-absolute top-50 start-50 mx-n4">
      <a class="glightbox icon-shape rounded-circle icon-xl pulser" href="https://www.youtube.com/watch?v=seLEvrZ6_6w&t=301s">
        <i class="fe fe-play"></i>
      </a>
    </div>
    <div class="position-absolute bottom-0 mb-6 start-0 end-0 ps-4">
      <div class="bg-dark d-inline-block p-2 px-3 text-white fw-semibold">Her<br> 86m2</div>
      <div class="bg-white d-inline-block p-2 px-3 text-dark fw-semibold ms-5">
        <span class="text-gray-500">Gardening Tips</span>
        <span class="mx-2">Canada</span>
        <svg width="24" height="24" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0_8060_1993)">
            <path d="M36 72C55.8823 72 72 55.8823 72 36C72 16.1177 55.8823 0 36 0C16.1177 0 0 16.1177 0 36C0 55.8823 16.1177 72 36 72Z" fill="#F0F0F0"></path>
            <path d="M72.0027 36.003C72.0027 21.7304 63.6966 9.39819 51.6548 3.5752V68.4307C63.6966 62.6079 72.0027 50.2756 72.0027 36.003Z" fill="#D80027"></path>
            <path d="M0.00146484 36.0011C0.00146484 50.2737 8.30748 62.6059 20.3493 68.4289V3.57324C8.30748 9.39624 0.00146484 21.7285 0.00146484 36.0011Z" fill="#D80027"></path>
            <path
              d="M42.2626 40.6985L48.5233 37.5681L45.393 36.0029V32.8724L39.1321 36.0029L42.2626 29.742H39.1321L36.0017 25.0464L32.8712 29.742H29.7407L32.8712 36.0029L26.6103 32.8724V36.0029L23.48 37.5681L29.7407 40.6985L28.1756 43.829H34.4365V48.5246H37.5668V43.829H43.8277L42.2626 40.6985Z"
              fill="#D80027"></path>
          </g>
          <defs>
            <clipPath id="clip0_8060_1993">
              <rect width="72" height="72" fill="white"></rect>
            </clipPath>
          </defs>
        </svg>
      </div>
    </div>
  </div>
</div>
            <div class="col-xl-8 col-lg-6 col-12">
              <div class="px-xl-8 my-lg-6">
                <div class="mb-5">
                  <span class="fw-semibold text-success">Testimonials</span>
                  <h2 class="h1 mt-3 mb-0">What Our Gardeners Say</h2>
                  <p class="mb-0">Here’s what our community members have to say about their experiences with GardenShare:</p>
                </div>
                <div class="position-relative">
                  <div class="sliderTestimonialFourth">
                    <!-- item -->
                    <div class="item">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex align-items-center gap-3 mb-3">
                            <img src="../../assets/images/avatar/avatar-1.jpg" alt="" class="avatar avatar-lg rounded-circle" />
                            <div>
                              <h3 class="h4 mb-0">Shawn Beltran</h3>
                              <p class="d-flex gap-2 mb-0">
                                <small>Columbia University</small>

                                <small class="text-dark fw-semibold">New York</small>
                              </p>
                            </div>
                          </div>
                          <p class="mb-0">"The personalized support I received was invaluable. Thanks to the expert guidance and resources, I scored above my target on the TOEFL!"</p>
                        </div>
                      </div>
                    </div>
                    <!-- item -->
                    <div class="item">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex align-items-center gap-3 mb-3">
                            <img src="../../assets/images/avatar/avatar-3.jpg" alt="" class="avatar avatar-lg rounded-circle" />
                            <div>
                              <h3 class="h4 mb-0">Liya Pickett</h3>
                              <p class="d-flex gap-2 mb-0">
                                <small>Georgia State University</small>

                                <small class="text-dark fw-semibold">Atlanta</small>
                              </p>
                            </div>
                          </div>
                          <p class="mb-0">"I was impressed with the IELTS course. The detailed study materials and interactive classes helped me improve my score significantly."</p>
                        </div>
                      </div>
                    </div>
                    <!-- item -->
                    <div class="item">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex align-items-center gap-3 mb-3">
                            <img src="../../assets/images/avatar/avatar-9.jpg" alt="" class="avatar avatar-lg rounded-circle" />
                            <div>
                              <h3 class="h4 mb-0">Nilarj Misty</h3>
                              <p class="d-flex gap-2 mb-0">
                                <small>Georgia State University</small>

                                <small class="text-dark fw-semibold">Atlanta</small>
                              </p>
                            </div>
                          </div>
                          <p class="mb-0">"I was impressed with the IELTS course. The detailed study materials and interactive classes helped me improve my score significantly."</p>
                        </div>
                      </div>
                    </div>
                    <!-- item -->
                    <div class="item">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex align-items-center gap-3 mb-3">
                            <img src="../../assets/images/avatar/avatar-8.jpg" alt="" class="avatar avatar-lg rounded-circle" />
                            <div>
                              <h3 class="h4 mb-0">Kevos Maziz</h3>
                              <p class="d-flex gap-2 mb-0">
                                <small>Georgia State University</small>

                                <small class="text-dark fw-semibold">Atlanta</small>
                              </p>
                            </div>
                          </div>
                          <p class="mb-0">"I was impressed with the IELTS course. The detailed study materials and interactive classes helped me improve my score significantly."</p>
                        </div>
                      </div>
                    </div>
                    <!-- item -->
                    <div class="item">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex align-items-center gap-3 mb-3">
                            <img src="../../assets/images/avatar/avatar-6.jpg" alt="" class="avatar avatar-lg rounded-circle" />
                            <div>
                              <h3 class="h4 mb-0">Simon Detol</h3>
                              <p class="d-flex gap-2 mb-0">
                                <small>Georgia State University</small>

                                <small class="text-dark fw-semibold">Atlanta</small>
                              </p>
                            </div>
                          </div>
                          <p class="mb-0">"I was impressed with the IELTS course. The detailed study materials and interactive classes helped me improve my score significantly."</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <ul class="controls-testimonial controls justify-content-start" id="sliderTestimonialFourthControls">
                    <li class="prev ms-0">
                      <i class="fe fe-chevron-left"></i>
                    </li>
                    <li class="next ms-2">
                      <i class="fe fe-chevron-right"></i>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


</main>
@endsection
