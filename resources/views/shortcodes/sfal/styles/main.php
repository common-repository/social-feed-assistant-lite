<?php defined('ABSPATH') || exit('no access') ?>
/************************* Custom bootstrap *************************/
.sfal-container {
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}

@media (min-width: 576px) {
  .sfal-container {
    max-width: 540px;
  }
}

@media (min-width: 768px) {
  .sfal-container {
    max-width: 720px;
  }
}

@media (min-width: 992px) {
  .sfal-container {
    max-width: 960px;
  }
}

@media (min-width: 1200px) {
  .sfal-container {
    max-width: 1140px;
  }
}

.sfal-container-fluid, .sfal-container-sm, .sfal-container-md, .sfal-container-lg, .sfal-container-xl {
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}

@media (min-width: 576px) {
  .sfal-container, .sfal-container-sm {
    max-width: 540px;
  }
}

@media (min-width: 768px) {
  .sfal-container, .sfal-container-sm, .sfal-container-md {
    max-width: 720px;
  }
}

@media (min-width: 992px) {
  .sfal-container, .sfal-container-sm, .sfal-container-md, .sfal-container-lg {
    max-width: 960px;
  }
}

@media (min-width: 1200px) {
  .sfal-container, .sfal-container-sm, .sfal-container-md, .sfal-container-lg, .sfal-container-xl {
    max-width: 1140px;
  }
}

.sfal-row {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px;
}

.sfal-no-gutters {
  margin-right: 0;
  margin-left: 0;
}

.sfal-no-gutters > .sfal-col,
.sfal-no-gutters > [class*="col-"] {
  padding-right: 0;
  padding-left: 0;
}

.sfal-col-1, .sfal-col-2, .sfal-col-3, .sfal-col-4, .sfal-col-5, .sfal-col-6, .sfal-col-7, .sfal-col-8, .sfal-col-9, .sfal-col-10, .sfal-col-11, .sfal-col-12, .sfal-col,
.sfal-col-auto, .sfal-col-sm-1, .sfal-col-sm-2, .sfal-col-sm-3, .sfal-col-sm-4, .sfal-col-sm-5, .sfal-col-sm-6, .sfal-col-sm-7, .sfal-col-sm-8, .sfal-col-sm-9, .sfal-col-sm-10, .sfal-col-sm-11, .sfal-col-sm-12, .sfal-col-sm,
.sfal-col-sm-auto, .sfal-col-md-1, .sfal-col-md-2, .sfal-col-md-3, .sfal-col-md-4, .sfal-col-md-5, .sfal-col-md-6, .sfal-col-md-7, .sfal-col-md-8, .sfal-col-md-9, .sfal-col-md-10, .sfal-col-md-11, .sfal-col-md-12, .sfal-col-md,
.sfal-col-md-auto, .sfal-col-lg-1, .sfal-col-lg-2, .sfal-col-lg-3, .sfal-col-lg-4, .sfal-col-lg-5, .sfal-col-lg-6, .sfal-col-lg-7, .sfal-col-lg-8, .sfal-col-lg-9, .sfal-col-lg-10, .sfal-col-lg-11, .sfal-col-lg-12, .sfal-col-lg,
.sfal-col-lg-auto, .sfal-col-xl-1, .sfal-col-xl-2, .sfal-col-xl-3, .sfal-col-xl-4, .sfal-col-xl-5, .sfal-col-xl-6, .sfal-col-xl-7, .sfal-col-xl-8, .sfal-col-xl-9, .sfal-col-xl-10, .sfal-col-xl-11, .sfal-col-xl-12, .sfal-col-xl,
.sfal-col-xl-auto,

.sfal-col-11-ths, .sfal-col-9-ths, .sfal-col-7-ths, .sfal-col-5-ths, .sfal-col-3-ths, .sfal-col-1-ths,
.sfal-col-sm-11-ths, .sfal-col-sm-10-ths .sfal-col-sm-9-ths, .sfal-col-sm-8-ths, .sfal-col-sm-7-ths, .sfal-col-sm-5-ths, .sfal-col-sm-3-ths, .sfal-col-sm-1-ths,
.sfal-col-md-11-ths, .sfal-col-md-10-ths .sfal-col-md-9-ths, .sfal-col-md-8-ths, .sfal-col-md-7-ths, .sfal-col-md-5-ths, .sfal-col-md-3-ths, .sfal-col-md-1-ths,
.sfal-col-lg-11-ths, .sfal-col-lg-10-ths .sfal-col-lg-9-ths, .sfal-col-lg-8-ths, .sfal-col-lg-7-ths, .sfal-col-lg-5-ths, .sfal-col-lg-3-ths, .sfal-col-lg-1-ths,
.sfal-col-xl-11-ths, .sfal-col-xl-10-ths .sfal-col-xl-9-ths, .sfal-col-xl-8-ths, .sfal-col-xl-7-ths, .sfal-col-xl-5-ths, .sfal-col-xl-3-ths, .sfal-col-xl-1-ths
{
  width: 100%;
}

.sfal-col {
  -ms-flex-preferred-size: 0;
  flex-basis: 0;
  -ms-flex-positive: 1;
  flex-grow: 1;
  max-width: 100%;
}

.sfal-row-cols-1 > * {
  -ms-flex: 0 0 100%;
  flex: 0 0 100%;
  max-width: 100%;
}

.sfal-row-cols-2 > * {
  -ms-flex: 0 0 50%;
  flex: 0 0 50%;
  max-width: 50%;
}

.sfal-row-cols-3 > * {
  -ms-flex: 0 0 33.333333%;
  flex: 0 0 33.333333%;
  max-width: 33.333333%;
}

.sfal-row-cols-4 > * {
  -ms-flex: 0 0 25%;
  flex: 0 0 25%;
  max-width: 25%;
}

.sfal-row-cols-5 > * {
  -ms-flex: 0 0 20%;
  flex: 0 0 20%;
  max-width: 20%;
}

.sfal-row-cols-6 > * {
  -ms-flex: 0 0 16.666667%;
  flex: 0 0 16.666667%;
  max-width: 16.666667%;
}

.sfal-col-auto {
  -ms-flex: 0 0 auto;
  flex: 0 0 auto;
  width: auto;
  max-width: 100%;
}

.sfal-col-1 {
  -ms-flex: 0 0 8.333333%;
  flex: 0 0 8.333333%;
  max-width: 8.333333%;
}

.sfal-col-2 {
  -ms-flex: 0 0 16.666667%;
  flex: 0 0 16.666667%;
  max-width: 16.666667%;
}

.sfal-col-3 {
  -ms-flex: 0 0 25%;
  flex: 0 0 25%;
  max-width: 25%;
}

.sfal-col-4 {
  -ms-flex: 0 0 33.333333%;
  flex: 0 0 33.333333%;
  max-width: 33.333333%;
}

.sfal-col-5 {
  -ms-flex: 0 0 41.666667%;
  flex: 0 0 41.666667%;
  max-width: 41.666667%;
}

.sfal-col-6 {
  -ms-flex: 0 0 50%;
  flex: 0 0 50%;
  max-width: 50%;
}

.sfal-col-7 {
  -ms-flex: 0 0 58.333333%;
  flex: 0 0 58.333333%;
  max-width: 58.333333%;
}

.sfal-col-8 {
  -ms-flex: 0 0 66.666667%;
  flex: 0 0 66.666667%;
  max-width: 66.666667%;
}

.sfal-col-9 {
  -ms-flex: 0 0 75%;
  flex: 0 0 75%;
  max-width: 75%;
}

.sfal-col-10 {
  -ms-flex: 0 0 83.333333%;
  flex: 0 0 83.333333%;
  max-width: 83.333333%;
}

.sfal-col-11 {
  -ms-flex: 0 0 91.666667%;
  flex: 0 0 91.666667%;
  max-width: 91.666667%;
}

.sfal-col-12 {
  -ms-flex: 0 0 100%;
  flex: 0 0 100%;
  max-width: 100%;
}


// custom

.sfal-col-11-ths {
  -ms-flex: 0 0 9.090909%;
  flex: 0 0 9.090909%;
  max-width: 9.090909%;
}

.sfal-col-10-ths {
  -ms-flex: 0 0 10%;
  flex: 0 0 10%;
  max-width: 10%;
}

.sfal-col-9-ths {
  -ms-flex: 0 0 11.111111%;
  flex: 0 0 11.111111%;
  max-width: 11.111111%;
}

.sfal-col-8-ths {
  -ms-flex: 0 0 12.5%;
  flex: 0 0 12.5%;
  max-width: 12.5%;
}

.sfal-col-7-ths {
  -ms-flex: 0 0 14.28%;
  flex: 0 0 14.28%;
  max-width: 14.28%;
}
.sfal-col-5-ths {
    -ms-flex: 0 0 20%;
    flex: 0 0 20%;
    max-width: 20%; 
}
.sfal-col-3-ths {
  -ms-flex: 0 0 33.333333%;
  flex: 0 0 33.333333%;
  max-width: 33.333333%;
}
.sfal-col-1-ths {
  -ms-flex: 0 0 100%;
  flex: 0 0 100%;
  max-width: 100%;
}

// end custom




.sfal-order-first {
  -ms-flex-order: -1;
  order: -1;
}

.sfal-order-last {
  -ms-flex-order: 13;
  order: 13;
}

.sfal-order-0 {
  -ms-flex-order: 0;
  order: 0;
}

.sfal-order-1 {
  -ms-flex-order: 1;
  order: 1;
}

.sfal-order-2 {
  -ms-flex-order: 2;
  order: 2;
}

.sfal-order-3 {
  -ms-flex-order: 3;
  order: 3;
}

.sfal-order-4 {
  -ms-flex-order: 4;
  order: 4;
}

.sfal-order-5 {
  -ms-flex-order: 5;
  order: 5;
}

.sfal-order-6 {
  -ms-flex-order: 6;
  order: 6;
}

.sfal-order-7 {
  -ms-flex-order: 7;
  order: 7;
}

.sfal-order-8 {
  -ms-flex-order: 8;
  order: 8;
}

.sfal-order-9 {
  -ms-flex-order: 9;
  order: 9;
}

.sfal-order-10 {
  -ms-flex-order: 10;
  order: 10;
}

.sfal-order-11 {
  -ms-flex-order: 11;
  order: 11;
}

.sfal-order-12 {
  -ms-flex-order: 12;
  order: 12;
}

.sfal-offset-1 {
  margin-left: 8.333333%;
}

.sfal-offset-2 {
  margin-left: 16.666667%;
}

.sfal-offset-3 {
  margin-left: 25%;
}

.sfal-offset-4 {
  margin-left: 33.333333%;
}

.sfal-offset-5 {
  margin-left: 41.666667%;
}

.sfal-offset-6 {
  margin-left: 50%;
}

.sfal-offset-7 {
  margin-left: 58.333333%;
}

.sfal-offset-8 {
  margin-left: 66.666667%;
}

.sfal-offset-9 {
  margin-left: 75%;
}

.sfal-offset-10 {
  margin-left: 83.333333%;
}

.sfal-offset-11 {
  margin-left: 91.666667%;
}

@media (min-width: 576px) {
  .sfal-col-sm {
    -ms-flex-preferred-size: 0;
    flex-basis: 0;
    -ms-flex-positive: 1;
    flex-grow: 1;
    max-width: 100%;
  }
  .sfal-row-cols-sm-1 > * {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
  }
  .sfal-row-cols-sm-2 > * {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
  }
  .sfal-row-cols-sm-3 > * {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
  }
  .sfal-row-cols-sm-4 > * {
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 25%;
  }
  .sfal-row-cols-sm-5 > * {
    -ms-flex: 0 0 20%;
    flex: 0 0 20%;
    max-width: 20%;
  }
  .sfal-row-cols-sm-6 > * {
    -ms-flex: 0 0 16.666667%;
    flex: 0 0 16.666667%;
    max-width: 16.666667%;
  }
  .sfal-col-sm-auto {
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    width: auto;
    max-width: 100%;
  }
  .sfal-col-sm-1 {
    -ms-flex: 0 0 8.333333%;
    flex: 0 0 8.333333%;
    max-width: 8.333333%;
  }
  .sfal-col-sm-2 {
    -ms-flex: 0 0 16.666667%;
    flex: 0 0 16.666667%;
    max-width: 16.666667%;
  }
  .sfal-col-sm-3 {
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 25%;
  }
  .sfal-col-sm-4 {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
  }
  .sfal-col-sm-5 {
    -ms-flex: 0 0 41.666667%;
    flex: 0 0 41.666667%;
    max-width: 41.666667%;
  }
  .sfal-col-sm-6 {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
  }
  .sfal-col-sm-7 {
    -ms-flex: 0 0 58.333333%;
    flex: 0 0 58.333333%;
    max-width: 58.333333%;
  }
  .sfal-col-sm-8 {
    -ms-flex: 0 0 66.666667%;
    flex: 0 0 66.666667%;
    max-width: 66.666667%;
  }
  .sfal-col-sm-9 {
    -ms-flex: 0 0 75%;
    flex: 0 0 75%;
    max-width: 75%;
  }
  .sfal-col-sm-10 {
    -ms-flex: 0 0 83.333333%;
    flex: 0 0 83.333333%;
    max-width: 83.333333%;
  }
  .sfal-col-sm-11 {
    -ms-flex: 0 0 91.666667%;
    flex: 0 0 91.666667%;
    max-width: 91.666667%;
  }
  .sfal-col-sm-12 {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
  }

  .sfal-col-sm-11-ths {
    -ms-flex: 0 0 9.090909%;
    flex: 0 0 9.090909%;
    max-width: 9.090909%;
  }

  .sfal-col-sm-10-ths {
    -ms-flex: 0 0 10%;
    flex: 0 0 10%;
    max-width: 10%;
  }

  .sfal-col-sm-9-ths {
    -ms-flex: 0 0 11.111111%;
    flex: 0 0 11.111111%;
    max-width: 11.111111%;
  }

  .sfal-col-sm-8-ths {
    -ms-flex: 0 0 12.5%;
    flex: 0 0 12.5%;
    max-width: 12.5%;
  }

  .sfal-col-sm-7-ths {
    -ms-flex: 0 0 14.28%;
    flex: 0 0 14.28%;
    max-width: 14.28%;
  }
  .sfal-col-sm-5-ths {
    -ms-flex: 0 0 20%;
    flex: 0 0 20%;
    max-width: 20%; 
  }
  .sfal-col-sm-3-ths {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
  }
  .sfal-col-sm-1-ths {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
  }

  .sfal-order-sm-first {
    -ms-flex-order: -1;
    order: -1;
  }
  .sfal-order-sm-last {
    -ms-flex-order: 13;
    order: 13;
  }
  .sfal-order-sm-0 {
    -ms-flex-order: 0;
    order: 0;
  }
  .sfal-order-sm-1 {
    -ms-flex-order: 1;
    order: 1;
  }
  .sfal-order-sm-2 {
    -ms-flex-order: 2;
    order: 2;
  }
  .sfal-order-sm-3 {
    -ms-flex-order: 3;
    order: 3;
  }
  .sfal-order-sm-4 {
    -ms-flex-order: 4;
    order: 4;
  }
  .sfal-order-sm-5 {
    -ms-flex-order: 5;
    order: 5;
  }
  .sfal-order-sm-6 {
    -ms-flex-order: 6;
    order: 6;
  }
  .sfal-order-sm-7 {
    -ms-flex-order: 7;
    order: 7;
  }
  .sfal-order-sm-8 {
    -ms-flex-order: 8;
    order: 8;
  }
  .sfal-order-sm-9 {
    -ms-flex-order: 9;
    order: 9;
  }
  .sfal-order-sm-10 {
    -ms-flex-order: 10;
    order: 10;
  }
  .sfal-order-sm-11 {
    -ms-flex-order: 11;
    order: 11;
  }
  .sfal-order-sm-12 {
    -ms-flex-order: 12;
    order: 12;
  }
  .sfal-offset-sm-0 {
    margin-left: 0;
  }
  .sfal-offset-sm-1 {
    margin-left: 8.333333%;
  }
  .sfal-offset-sm-2 {
    margin-left: 16.666667%;
  }
  .sfal-offset-sm-3 {
    margin-left: 25%;
  }
  .sfal-offset-sm-4 {
    margin-left: 33.333333%;
  }
  .sfal-offset-sm-5 {
    margin-left: 41.666667%;
  }
  .sfal-offset-sm-6 {
    margin-left: 50%;
  }
  .sfal-offset-sm-7 {
    margin-left: 58.333333%;
  }
  .sfal-offset-sm-8 {
    margin-left: 66.666667%;
  }
  .sfal-offset-sm-9 {
    margin-left: 75%;
  }
  .sfal-offset-sm-10 {
    margin-left: 83.333333%;
  }
  .sfal-offset-sm-11 {
    margin-left: 91.666667%;
  }
}

@media (min-width: 768px) {
  .sfal-col-md {
    -ms-flex-preferred-size: 0;
    flex-basis: 0;
    -ms-flex-positive: 1;
    flex-grow: 1;
    max-width: 100%;
  }
  .sfal-row-cols-md-1 > * {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
  }
  .sfal-row-cols-md-2 > * {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
  }
  .sfal-row-cols-md-3 > * {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
  }
  .sfal-row-cols-md-4 > * {
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 25%;
  }
  .sfal-row-cols-md-5 > * {
    -ms-flex: 0 0 20%;
    flex: 0 0 20%;
    max-width: 20%;
  }
  .sfal-row-cols-md-6 > * {
    -ms-flex: 0 0 16.666667%;
    flex: 0 0 16.666667%;
    max-width: 16.666667%;
  }
  .sfal-col-md-auto {
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    width: auto;
    max-width: 100%;
  }
  .sfal-col-md-1 {
    -ms-flex: 0 0 8.333333%;
    flex: 0 0 8.333333%;
    max-width: 8.333333%;
  }
  .sfal-col-md-2 {
    -ms-flex: 0 0 16.666667%;
    flex: 0 0 16.666667%;
    max-width: 16.666667%;
  }
  .sfal-col-md-3 {
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 25%;
  }
  .sfal-col-md-4 {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
  }
  .sfal-col-md-5 {
    -ms-flex: 0 0 41.666667%;
    flex: 0 0 41.666667%;
    max-width: 41.666667%;
  }
  .sfal-col-md-6 {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
  }
  .sfal-col-md-7 {
    -ms-flex: 0 0 58.333333%;
    flex: 0 0 58.333333%;
    max-width: 58.333333%;
  }
  .sfal-col-md-8 {
    -ms-flex: 0 0 66.666667%;
    flex: 0 0 66.666667%;
    max-width: 66.666667%;
  }
  .sfal-col-md-9 {
    -ms-flex: 0 0 75%;
    flex: 0 0 75%;
    max-width: 75%;
  }
  .sfal-col-md-10 {
    -ms-flex: 0 0 83.333333%;
    flex: 0 0 83.333333%;
    max-width: 83.333333%;
  }
  .sfal-col-md-11 {
    -ms-flex: 0 0 91.666667%;
    flex: 0 0 91.666667%;
    max-width: 91.666667%;
  }
  .sfal-col-md-12 {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
  }

  .sfal-col-md-11-ths {
    -ms-flex: 0 0 9.090909%;
    flex: 0 0 9.090909%;
    max-width: 9.090909%;
  }
  .sfal-col-md-10-ths {
    -ms-flex: 0 0 10%;
    flex: 0 0 10%;
    max-width: 10%;
  }
  .sfal-col-md-9-ths {
    -ms-flex: 0 0 11.111111%;
    flex: 0 0 11.111111%;
    max-width: 11.111111%;
  }
  .sfal-col-md-8-ths {
    -ms-flex: 0 0 12.5%;
    flex: 0 0 12.5%;
    max-width: 12.5%;
  }
  .sfal-col-md-7-ths {
    -ms-flex: 0 0 14.28%;
    flex: 0 0 14.28%;
    max-width: 14.28%;
  }
  .sfal-col-md-5-ths {
    -ms-flex: 0 0 20%;
    flex: 0 0 20%;
    max-width: 20%;
  }
  .sfal-col-md-3-ths {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
  }
  .sfal-col-md-1-ths {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
  }

  .sfal-order-md-first {
    -ms-flex-order: -1;
    order: -1;
  }
  .sfal-order-md-last {
    -ms-flex-order: 13;
    order: 13;
  }
  .sfal-order-md-0 {
    -ms-flex-order: 0;
    order: 0;
  }
  .sfal-order-md-1 {
    -ms-flex-order: 1;
    order: 1;
  }
  .sfal-order-md-2 {
    -ms-flex-order: 2;
    order: 2;
  }
  .sfal-order-md-3 {
    -ms-flex-order: 3;
    order: 3;
  }
  .sfal-order-md-4 {
    -ms-flex-order: 4;
    order: 4;
  }
  .sfal-order-md-5 {
    -ms-flex-order: 5;
    order: 5;
  }
  .sfal-order-md-6 {
    -ms-flex-order: 6;
    order: 6;
  }
  .sfal-order-md-7 {
    -ms-flex-order: 7;
    order: 7;
  }
  .sfal-order-md-8 {
    -ms-flex-order: 8;
    order: 8;
  }
  .sfal-order-md-9 {
    -ms-flex-order: 9;
    order: 9;
  }
  .sfal-order-md-10 {
    -ms-flex-order: 10;
    order: 10;
  }
  .sfal-order-md-11 {
    -ms-flex-order: 11;
    order: 11;
  }
  .sfal-order-md-12 {
    -ms-flex-order: 12;
    order: 12;
  }
  .sfal-offset-md-0 {
    margin-left: 0;
  }
  .sfal-offset-md-1 {
    margin-left: 8.333333%;
  }
  .sfal-offset-md-2 {
    margin-left: 16.666667%;
  }
  .sfal-offset-md-3 {
    margin-left: 25%;
  }
  .sfal-offset-md-4 {
    margin-left: 33.333333%;
  }
  .sfal-offset-md-5 {
    margin-left: 41.666667%;
  }
  .sfal-offset-md-6 {
    margin-left: 50%;
  }
  .sfal-offset-md-7 {
    margin-left: 58.333333%;
  }
  .sfal-offset-md-8 {
    margin-left: 66.666667%;
  }
  .sfal-offset-md-9 {
    margin-left: 75%;
  }
  .sfal-offset-md-10 {
    margin-left: 83.333333%;
  }
  .sfal-offset-md-11 {
    margin-left: 91.666667%;
  }
}

@media (min-width: 992px) {
  .sfal-col-lg {
    -ms-flex-preferred-size: 0;
    flex-basis: 0;
    -ms-flex-positive: 1;
    flex-grow: 1;
    max-width: 100%;
  }
  .sfal-row-cols-lg-1 > * {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
  }
  .sfal-row-cols-lg-2 > * {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
  }
  .sfal-row-cols-lg-3 > * {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
  }
  .sfal-row-cols-lg-4 > * {
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 25%;
  }
  .sfal-row-cols-lg-5 > * {
    -ms-flex: 0 0 20%;
    flex: 0 0 20%;
    max-width: 20%;
  }
  .sfal-row-cols-lg-6 > * {
    -ms-flex: 0 0 16.666667%;
    flex: 0 0 16.666667%;
    max-width: 16.666667%;
  }
  .sfal-col-lg-auto {
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    width: auto;
    max-width: 100%;
  }
  .sfal-col-lg-1 {
    -ms-flex: 0 0 8.333333%;
    flex: 0 0 8.333333%;
    max-width: 8.333333%;
  }
  .sfal-col-lg-2 {
    -ms-flex: 0 0 16.666667%;
    flex: 0 0 16.666667%;
    max-width: 16.666667%;
  }
  .sfal-col-lg-3 {
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 25%;
  }
  .sfal-col-lg-4 {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
  }
  .sfal-col-lg-5 {
    -ms-flex: 0 0 41.666667%;
    flex: 0 0 41.666667%;
    max-width: 41.666667%;
  }
  .sfal-col-lg-6 {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
  }
  .sfal-col-lg-7 {
    -ms-flex: 0 0 58.333333%;
    flex: 0 0 58.333333%;
    max-width: 58.333333%;
  }
  .sfal-col-lg-8 {
    -ms-flex: 0 0 66.666667%;
    flex: 0 0 66.666667%;
    max-width: 66.666667%;
  }
  .sfal-col-lg-9 {
    -ms-flex: 0 0 75%;
    flex: 0 0 75%;
    max-width: 75%;
  }
  .sfal-col-lg-10 {
    -ms-flex: 0 0 83.333333%;
    flex: 0 0 83.333333%;
    max-width: 83.333333%;
  }
  .sfal-col-lg-11 {
    -ms-flex: 0 0 91.666667%;
    flex: 0 0 91.666667%;
    max-width: 91.666667%;
  }
  .sfal-col-lg-12 {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
  }

  .sfal-col-lg-11-ths {
    -ms-flex: 0 0 9.090909%;
    flex: 0 0 9.090909%;
    max-width: 9.090909%;
  }
  .sfal-col-lg-10-ths {
    -ms-flex: 0 0 10%;
    flex: 0 0 10%;
    max-width: 10%;
  }
  .sfal-col-lg-9-ths {
    -ms-flex: 0 0 11.111111%;
    flex: 0 0 11.111111%;
    max-width: 11.111111%;
  }
  .sfal-col-lg-8-ths {
    -ms-flex: 0 0 12.5%;
    flex: 0 0 12.5%;
    max-width: 12.5%;
  }
  .sfal-col-lg-7-ths {
    -ms-flex: 0 0 14.28%;
    flex: 0 0 14.28%;
    max-width: 14.28%;
  }
  .sfal-col-lg-5-ths {
    -ms-flex: 0 0 20%;
    flex: 0 0 20%;
    max-width: 20%;
  }
  .sfal-col-lg-3-ths {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
  }
  .sfal-col-lg-1-ths {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
  }

  .sfal-order-lg-first {
    -ms-flex-order: -1;
    order: -1;
  }
  .sfal-order-lg-last {
    -ms-flex-order: 13;
    order: 13;
  }
  .sfal-order-lg-0 {
    -ms-flex-order: 0;
    order: 0;
  }
  .sfal-order-lg-1 {
    -ms-flex-order: 1;
    order: 1;
  }
  .sfal-order-lg-2 {
    -ms-flex-order: 2;
    order: 2;
  }
  .sfal-order-lg-3 {
    -ms-flex-order: 3;
    order: 3;
  }
  .sfal-order-lg-4 {
    -ms-flex-order: 4;
    order: 4;
  }
  .sfal-order-lg-5 {
    -ms-flex-order: 5;
    order: 5;
  }
  .sfal-order-lg-6 {
    -ms-flex-order: 6;
    order: 6;
  }
  .sfal-order-lg-7 {
    -ms-flex-order: 7;
    order: 7;
  }
  .sfal-order-lg-8 {
    -ms-flex-order: 8;
    order: 8;
  }
  .sfal-order-lg-9 {
    -ms-flex-order: 9;
    order: 9;
  }
  .sfal-order-lg-10 {
    -ms-flex-order: 10;
    order: 10;
  }
  .sfal-order-lg-11 {
    -ms-flex-order: 11;
    order: 11;
  }
  .sfal-order-lg-12 {
    -ms-flex-order: 12;
    order: 12;
  }
  .sfal-offset-lg-0 {
    margin-left: 0;
  }
  .sfal-offset-lg-1 {
    margin-left: 8.333333%;
  }
  .sfal-offset-lg-2 {
    margin-left: 16.666667%;
  }
  .sfal-offset-lg-3 {
    margin-left: 25%;
  }
  .sfal-offset-lg-4 {
    margin-left: 33.333333%;
  }
  .sfal-offset-lg-5 {
    margin-left: 41.666667%;
  }
  .sfal-offset-lg-6 {
    margin-left: 50%;
  }
  .sfal-offset-lg-7 {
    margin-left: 58.333333%;
  }
  .sfal-offset-lg-8 {
    margin-left: 66.666667%;
  }
  .sfal-offset-lg-9 {
    margin-left: 75%;
  }
  .offset-lg-10 {
    margin-left: 83.333333%;
  }
  .sfal-offset-lg-11 {
    margin-left: 91.666667%;
  }
}

@media (min-width: 1200px) {
  .sfal-col-xl {
    -ms-flex-preferred-size: 0;
    flex-basis: 0;
    -ms-flex-positive: 1;
    flex-grow: 1;
    max-width: 100%;
  }
  .sfal-row-cols-xl-1 > * {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
  }
  .sfal-row-cols-xl-2 > * {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
  }
  .sfal-row-cols-xl-3 > * {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
  }
  .sfal-row-cols-xl-4 > * {
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 25%;
  }
  .sfal-row-cols-xl-5 > * {
    -ms-flex: 0 0 20%;
    flex: 0 0 20%;
    max-width: 20%;
  }
  .sfal-row-cols-xl-6 > * {
    -ms-flex: 0 0 16.666667%;
    flex: 0 0 16.666667%;
    max-width: 16.666667%;
  }
  .sfal-col-xl-auto {
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    width: auto;
    max-width: 100%;
  }
  .sfal-col-xl-1 {
    -ms-flex: 0 0 8.333333%;
    flex: 0 0 8.333333%;
    max-width: 8.333333%;
  }
  .sfal-col-xl-2 {
    -ms-flex: 0 0 16.666667%;
    flex: 0 0 16.666667%;
    max-width: 16.666667%;
  }
  .sfal-col-xl-3 {
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 25%;
  }
  .sfal-col-xl-4 {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
  }
  .sfal-col-xl-5 {
    -ms-flex: 0 0 41.666667%;
    flex: 0 0 41.666667%;
    max-width: 41.666667%;
  }
  .sfal-col-xl-6 {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
  }
  .sfal-col-xl-7 {
    -ms-flex: 0 0 58.333333%;
    flex: 0 0 58.333333%;
    max-width: 58.333333%;
  }
  .sfal-col-xl-8 {
    -ms-flex: 0 0 66.666667%;
    flex: 0 0 66.666667%;
    max-width: 66.666667%;
  }
  .sfal-col-xl-9 {
    -ms-flex: 0 0 75%;
    flex: 0 0 75%;
    max-width: 75%;
  }
  .sfal-col-xl-10 {
    -ms-flex: 0 0 83.333333%;
    flex: 0 0 83.333333%;
    max-width: 83.333333%;
  }
  .sfal-col-xl-11 {
    -ms-flex: 0 0 91.666667%;
    flex: 0 0 91.666667%;
    max-width: 91.666667%;
  }
  .sfal-col-xl-12 {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
  }
  .sfal-col-xl-11-ths {
    -ms-flex: 0 0 9.090909%;
    flex: 0 0 9.090909%;
    max-width: 9.090909%;
  }
  .sfal-col-xl-10-ths {
    -ms-flex: 0 0 10%;
    flex: 0 0 10%;
    max-width: 10%;
  }
  .sfal-col-xl-9-ths {
    -ms-flex: 0 0 11.111111%;
    flex: 0 0 11.111111%;
    max-width: 11.111111%;
  }
  .sfal-col-xl-8-ths {
    -ms-flex: 0 0 12.5%;
    flex: 0 0 12.5%;
    max-width: 12.5%;
  }
  .sfal-col-xl-7-ths {
    -ms-flex: 0 0 14.28%;
    flex: 0 0 14.28%;
    max-width: 14.28%;
  }
  .sfal-col-xl-5-ths {
    -ms-flex: 0 0 20%;
    flex: 0 0 20%;
    max-width: 20%;
  }
  .sfal-col-xl-3-ths {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
  }
  .sfal-col-xl-1-ths {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
  }
  .sfal-order-xl-first {
    -ms-flex-order: -1;
    order: -1;
  }
  .sfal-order-xl-last {
    -ms-flex-order: 13;
    order: 13;
  }
  .sfal-order-xl-0 {
    -ms-flex-order: 0;
    order: 0;
  }
  .sfal-order-xl-1 {
    -ms-flex-order: 1;
    order: 1;
  }
  .sfal-order-xl-2 {
    -ms-flex-order: 2;
    order: 2;
  }
  .sfal-order-xl-3 {
    -ms-flex-order: 3;
    order: 3;
  }
  .sfal-order-xl-4 {
    -ms-flex-order: 4;
    order: 4;
  }
  .sfal-order-xl-5 {
    -ms-flex-order: 5;
    order: 5;
  }
  .sfal-order-xl-6 {
    -ms-flex-order: 6;
    order: 6;
  }
  .sfal-order-xl-7 {
    -ms-flex-order: 7;
    order: 7;
  }
  .sfal-order-xl-8 {
    -ms-flex-order: 8;
    order: 8;
  }
  .sfal-order-xl-9 {
    -ms-flex-order: 9;
    order: 9;
  }
  .sfal-order-xl-10 {
    -ms-flex-order: 10;
    order: 10;
  }
  .sfal-order-xl-11 {
    -ms-flex-order: 11;
    order: 11;
  }
  .sfal-order-xl-12 {
    -ms-flex-order: 12;
    order: 12;
  }
  .sfal-offset-xl-0 {
    margin-left: 0;
  }
  .sfal-offset-xl-1 {
    margin-left: 8.333333%;
  }
  .sfal-offset-xl-2 {
    margin-left: 16.666667%;
  }
  .sfal-offset-xl-3 {
    margin-left: 25%;
  }
  .sfal-offset-xl-4 {
    margin-left: 33.333333%;
  }
  .sfal-offset-xl-5 {
    margin-left: 41.666667%;
  }
  .sfal-offset-xl-6 {
    margin-left: 50%;
  }
  .sfal-offset-xl-7 {
    margin-left: 58.333333%;
  }
  .sfal-offset-xl-8 {
    margin-left: 66.666667%;
  }
  .sfal-offset-xl-9 {
    margin-left: 75%;
  }
  .sfal-offset-xl-10 {
    margin-left: 83.333333%;
  }
  .sfal-offset-xl-11 {
    margin-left: 91.666667%;
  }

}

.clearfix:before,
.clearfix:after,
.sfal-container:before,
.sfal-container:after,
.sfal-container-fluid:before,
.sfal-container-fluid:after,
.sfal-row:before,
.sfal-row:after {
  display: table;
  content: " ";
}
.clearfix:after,
.sfal-container:after,
.sfal-container-fluid:after,
.sfal-row:after {
  clear: both;
}
/************************* Custom bootstrap *************************/

/**************** Fonts *******************/
/* open-sans-regular - latin */
@font-face {
  font-family: "Open Sans";
  font-style: normal;
  font-weight: 400;
  src: url("<?php echo $assetsUrl ?>/fonts/open-sans-v17-latin/open-sans-v17-latin-regular.eot"); /* IE9 Compat Modes */
  src: local("Open Sans Regular"), local("OpenSans-Regular"),
    url("../fonts/open-sans-v17-latin/open-sans-v17-latin-regular.eot?#iefix")
      format("embedded-opentype"),
    /* IE6-IE8 */
      url("<?php echo $assetsUrl ?>/fonts/open-sans-v17-latin/open-sans-v17-latin-regular.woff2")
      format("woff2"),
    /* Super Modern Browsers */
      url("<?php echo $assetsUrl ?>/fonts/open-sans-v17-latin/open-sans-v17-latin-regular.woff")
      format("woff"),
    /* Modern Browsers */
      url("<?php echo $assetsUrl ?>/fonts/open-sans-v17-latin/open-sans-v17-latin-regular.ttf")
      format("truetype"),
    /* Safari, Android, iOS */
      url("<?php echo $assetsUrl ?>/fonts/open-sans-v17-latin/open-sans-v17-latin-regular.svg#OpenSans")
      format("svg"); /* Legacy iOS */
}

/* open-sans-600 - latin */
@font-face {
  font-family: "Open Sans";
  font-style: normal;
  font-weight: 600;
  src: url("<?php echo $assetsUrl ?>/fonts/open-sans-v17-latin/open-sans-v17-latin-600.eot"); /* IE9 Compat Modes */
  src: local("Open Sans SemiBold"), local("OpenSans-SemiBold"),
    url("<?php echo $assetsUrl ?>/fonts/open-sans-v17-latin/open-sans-v17-latin-600.eot?#iefix")
      format("embedded-opentype"),
    /* IE6-IE8 */
      url("<?php echo $assetsUrl ?>/fonts/open-sans-v17-latin/open-sans-v17-latin-600.woff2")
      format("woff2"),
    /* Super Modern Browsers */
      url("<?php echo $assetsUrl ?>/fonts/open-sans-v17-latin/open-sans-v17-latin-600.woff")
      format("woff"),
    /* Modern Browsers */
      url("<?php echo $assetsUrl ?>/fonts/open-sans-v17-latin/open-sans-v17-latin-600.ttf")
      format("truetype"),
    /* Safari, Android, iOS */
      url("<?php echo $assetsUrl ?>/fonts/open-sans-v17-latin/open-sans-v17-latin-600.svg#OpenSans")
      format("svg"); /* Legacy iOS */
}

/* open-sans-700 - latin */
@font-face {
  font-family: "Open Sans";
  font-style: normal;
  font-weight: 700;
  src: url("<?php echo $assetsUrl ?>/fonts/open-sans-v17-latin/open-sans-v17-latin-700.eot"); /* IE9 Compat Modes */
  src: local("Open Sans Bold"), local("OpenSans-Bold"),
    url("<?php echo $assetsUrl ?>/fonts/open-sans-v17-latin/open-sans-v17-latin-700.eot?#iefix")
      format("embedded-opentype"),
    /* IE6-IE8 */
      url("<?php echo $assetsUrl ?>/fonts/open-sans-v17-latin/open-sans-v17-latin-700.woff2")
      format("woff2"),
    /* Super Modern Browsers */
      url("<?php echo $assetsUrl ?>/fonts/open-sans-v17-latin/open-sans-v17-latin-700.woff")
      format("woff"),
    /* Modern Browsers */
      url("<?php echo $assetsUrl ?>/fonts/open-sans-v17-latin/open-sans-v17-latin-700.ttf")
      format("truetype"),
    /* Safari, Android, iOS */
      url("<?php echo $assetsUrl ?>/fonts/open-sans-v17-latin/open-sans-v17-latin-700.svg#OpenSans")
      format("svg"); /* Legacy iOS */
}

/**************** End Fonts *******************/
#sfal-stream-<?php echo $streamID ?>.sfal-stream-wrapper {
   position: relative;
   overflow: hidden
}
<?php if($options->general->maxContainer > 0) : ?>
#sfal-stream-<?php echo $streamID ?> {
  max-width: <?php echo $options->general->maxContainer ?>px;
  margin: 0 auto;
}
<?php endif; ?>

<?php if($options->general->postSettings->layout == "justified"): ?>
#sfal-stream-<?php echo $streamID ?> #sfal-row-<?php echo $streamID ?> {
  margin-right: 0;
  margin-left: 0;
}
<?php endif; ?>

/** Video player */
#sfal-stream-<?php echo $streamID ?> video,
#sfal-popup-<?php echo $streamID ?> video {
  max-width: 100%;
}

#sfal-stream-<?php echo $streamID ?> .video-wrapper,
#sfal-popup-<?php echo $streamID ?> .video-wrapper {
  display: inline-block;
  position: relative;
  z-index: 2;
  width: 100%;
  height: 100%;
}

#sfal-stream-<?php echo $streamID ?> .video-controls,
#sfal-popup-<?php echo $streamID ?> .video-controls {
  opacity: 0;
  transition: opacity .35s ease-out;
}

#sfal-stream-<?php echo $streamID ?> .video-controls--show,
#sfal-popup-<?php echo $streamID ?> .video-controls--show {
  opacity: 1;
}

#sfal-stream-<?php echo $streamID ?> [data-media],
#sfal-popup-<?php echo $streamID ?> [data-media] {
  padding: 0;
  margin: 0;
  background-color: transparent;
}

#sfal-stream-<?php echo $streamID ?> [data-media="play-pause"],
#sfal-popup-<?php echo $streamID ?> [data-media="play-pause"] {
  display: block;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  opacity: 1;
  transition: opacity .35s ease-out;
}
#sfal-stream-<?php echo $streamID ?> .paused [data-media="play-pause"],
#sfal-popup-<?php echo $streamID ?> .paused [data-media="play-pause"] {
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 30px 0 30px 52px;
  border-color: transparent transparent transparent #fff;
}
#sfal-stream-<?php echo $streamID ?> .playing [data-media="play-pause"],
#sfal-popup-<?php echo $streamID ?> .playing [data-media="play-pause"] {
  width: 52px;
  height: 60px;
  border: 16px solid #fff;
  border-top: none;
  border-bottom: none;
}
#sfal-stream-<?php echo $streamID ?> .hide-playhead [data-media="play-pause"],
#sfal-popup-<?php echo $streamID ?> .hide-playhead [data-media="play-pause"] {
  opacity: 0;
}

#sfal-stream-<?php echo $streamID ?> [data-media="mute-unmute"],
#sfal-popup-<?php echo $streamID ?> [data-media="mute-unmute"] {
    display: block;
    width: 15px;
    height: 15px;
    background-color: #a00c0c;
    position: absolute;
    top: 20px;
    right: 20px;
    border: 1px solid #eee;
    border-radius: 50%;
}

/** End Video player */
#sfal-stream-<?php echo $streamID ?>,
#sfal-popup-<?php echo $streamID ?> {
  font-size: 14px;
  line-height: 1.8;
  color: #929292;
  overflow-wrap: break-word;
  word-wrap: break-word;
}
#sfal-stream-<?php echo $streamID ?> a,
#sfal-popup-<?php echo $streamID ?> a {
  text-decoration: none;
}

#sfal-stream-<?php echo $streamID ?> img,
#sfal-popup-<?php echo $streamID ?> img {
  max-width: 100%;
  height: auto;
  vertical-align: middle;
  border: 0;
}

#sfal-stream-<?php echo $streamID ?> .sfal-swiper-prev i,
#sfal-stream-<?php echo $streamID ?> .sfal-swiper-next i{
  color: <?php echo $options->general->color->slider->arrows ?>;
}

#sfal-stream-<?php echo $streamID ?> .sfal-swiper-prev,
#sfal-stream-<?php echo $streamID ?> .sfal-swiper-next {
  font-size: 20px;
  position: absolute;
  top: 50%;
  display: block;
  padding: 3px 9px 3px 10px;
  -webkit-transform: translate(0, -50%);
  -ms-transform: translate(0, -50%);
  transform: translate(0, -50%);
  cursor: pointer;
  background: <?php echo $options->general->color->slider->arrowsBG ?>;
  z-index: 1000;
  border-radius: 2px;
  box-sizing: content-box;
}

#sfal-stream-<?php echo $streamID ?> .sfal-swiper-next {
  right: 20px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-swiper-prev {
  left: 20px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-swiper-container {
    margin-top: 20px;
    width: 100%;
}

#sfal-stream-<?php echo $streamID ?> .sfal-swiper-container .sfal-swiper-wrapper {
  padding: 10px 0;
  box-sizing: border-box;
}

#sfal-swiper-wrapper-<?php echo $streamID ?> .swiper-slide {
  height: auto;
}

#sfal-stream-<?php echo $streamID ?> .highlight {
  background-color: #b51212;
  color: #fff;
}

#sfal-stream-<?php echo $streamID ?> .sfal-failure-img-load,
#sfal-popup-<?php echo $streamID ?> .sfal-failure-img-load {
  background-image: url("data:image/png;base64,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") !important;
  background-repeat: no-repeat !important;
  background-position: center !important;
  background-size: cover !important;
}

#sfal-stream-<?php echo $streamID ?> .sfal-feeds-main-container {
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
  margin-bottom: 30px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-stream-wrapper-loader {
    text-align: center;
}

#sfal-stream-<?php echo $streamID ?> .sfal-stream-wrapper-loader > img {
    margin: 0 auto;
}

#sfal-stream-<?php echo $streamID ?> .lds-ellipsis {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
#sfal-stream-<?php echo $streamID ?> .lds-ellipsis div {
  position: absolute;
  top: 33px;
  width: 13px;
  height: 13px;
  border-radius: 50%;
  background: #616161;
  animation-timing-function: cubic-bezier(0, 1, 1, 0);
}

/* Pagination And Load More And Filter */

#sfal-stream-<?php echo $streamID ?> .sfal-pagination {
  text-align: center;
  padding: 20px 0;
}

#sfal-stream-<?php echo $streamID ?> .sfal-pagination-simple-link,
#sfal-stream-<?php echo $streamID ?> .sfal-pagination-circle-link,
#sfal-stream-<?php echo $streamID ?> .sfal-pagination-empty-circle-link {
  display: inline-block;
  color: #6d6d6d;
  text-decoration: none;
  line-height: 33px;
  padding: 0 13px;
  font-size: 12px;
  font-weight: 700;
}

#sfal-stream-<?php echo $streamID ?> .sfal-pagination-solid-link {
  border-bottom: 1px solid #b8b8b8;
  display: inline;
  padding: 10px 0;
}

#sfal-stream-<?php echo $streamID ?> .sfal-pagination-solid-link a {
  color: #6d6d6d;
  text-decoration: none;
  line-height: 33px;
  font-size: 12px;
  font-weight: 700;
  padding: 10px 13px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-pagination-solid-link a.active {
  border-bottom: 3px solid #4b9bc5;
  vertical-align: 1px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-pagination .sfal-pagination-simple-link.active {
  border-radius: 5px;
  background-color: #4b9bc5;
  color: #ffffff;
}

#sfal-stream-<?php echo $streamID ?> .sfal-pagination .sfal-pagination-circle-link.active {
  border-radius: 50%;
  background-color: #4b9bc5;
  color: #ffffff;
}

#sfal-stream-<?php echo $streamID ?> .sfal-pagination-empty-circle-link.active {
  border-radius: 50%;
  border: 2px solid #4b9bc5;
  color: #4b9bc5;
}

#sfal-stream-<?php echo $streamID ?> .sfal-load-more {
  text-align: center;
  padding: 15px 0;
}

#sfal-stream-<?php echo $streamID ?> .sfal-load-more-button {
  margin: 10px 0;
}

#sfal-stream-<?php echo $streamID ?> .sfal-load-more-spinner {
  display: inline-block;
  border-radius: 5px;
  background-color: rgba(48, 48, 48, 1);
  padding: 8px 40px;
  font-weight: 700;
  color: rgba(255, 255, 255, 1);
  font-size: 15px;
  line-height: 1.5;
  text-decoration: none;
  border: none;
}

#sfal-stream-<?php echo $streamID ?> .sfal-load-more-spinner i {
  font-weight: 700;
  padding: 0 2px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-load-more-simple {
  border-radius: 5px;
  background-color: #ffffff;
  border: 2px solid #4b9bc5;
  padding: 10px 23px;
  color: #4b9bc5;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;
  font-weight: 700;
}
#sfal-stream-<?php echo $streamID ?> .sfal-load-more-solid {
  color: #4b9bc5;
  font-size: 12px;
  font-weight: 700;
  position: relative;
  text-decoration: none;
}

#sfal-stream-<?php echo $streamID ?> .sfal-load-more-solid::after {
  content: "";
  display: block;
  position: absolute;
  top: 25px;
  right: 0;
  left: -15%;
  background: #4b9bc5;
  width: 130%;
  height: 3px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-stream-wrapper-header {
  width: 100%;
  text-align: center;
  margin-bottom: 20px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-stream-searchbox-container {
  margin: 25px auto;
}

#sfal-stream-<?php echo $streamID ?> .sfal-stream-searchbox-container p.sfal-stream-searchbox {
  position: relative;
  width: 35%;
  margin: 0 auto;
  color: #929292;
}

#sfal-stream-<?php echo $streamID ?> .sfal-stream-searchbox-container p.sfal-stream-searchbox span.sfal-stream-searchbox-icon {
  position: absolute;
  right: 30px;
  top: 8px;
  font-weight: bold;
  font-size: 18px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-stream-searchbox-container p.sfal-stream-searchbox input {
  border: 2px solid #c7c7c777;
  border-radius: 10px;
  font-size: 14px;
  color: rgba(109, 109, 109, 1);
  font-weight: bold;
  outline: none;
  text-transform: uppercase;
  width: 100%;
  letter-spacing: 2px;
  padding: 10px 40px 10px 20px;
  box-sizing: border-box;
}

#sfal-stream-<?php echo $streamID ?> .sfal-stream-searchbox-container p.sfal-stream-searchbox input::placeholder {
    color: #9a9a9a;
}

#sfal-stream-<?php echo $streamID ?> .sfal-stream-searchbox-container p.sfal-stream-searchbox input:hover,
#sfal-stream-<?php echo $streamID ?> .sfal-stream-searchbox-container p.sfal-stream-searchbox input:active,
#sfal-stream-<?php echo $streamID ?> .sfal-stream-searchbox-container p.sfal-stream-searchbox input:focus {
  border-color: #a9a9a9;
}

#sfal-stream-<?php echo $streamID ?> .sfal-filter > div {
  margin: 20px;
}


#sfal-stream-<?php echo $streamID ?> .sfal-filter span {
  display: inline-block;
  background-color: <?php echo $options->general->color->filter->background; ?>;
  color: <?php echo $options->general->color->filter->text; ?>;
  text-decoration: none;
  line-height: 33px;
  padding: 0 15px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  position: relative;
  margin-right: 5px;
  border-radius: 5px;
  transition: all 0.3s;
}

#sfal-stream-<?php echo $streamID ?> .sfal-filter-simple span:hover,
#sfal-stream-<?php echo $streamID ?> .sfal-filter-simple span.active {
  border-radius: 5px;
  background-color: <?php echo $options->general->color->filter->activeBg ?>;
  color: <?php echo $options->general->color->filter->activeText; ?>;
}

/* End Pagination And Load More And Filter */

<?php if ($options->general->actionOnImageClick == '1' || $options->general->actionOnImageClick == '2') : ?>

/* popup start */
#sfal-popup-<?php echo $streamID ?> .sfal-popup-container.swiper-container {
  min-height: 100%;
}

#sfal-popup-<?php echo $streamID ?> {
    position: fixed;
    box-sizing: border-box;
    background: <?php echo $options->general->color->popup->overlay; ?> !important;
    overflow-y: scroll;
    opacity: 0;
    visibility: hidden;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 0;
    perspective: 1000px;
    -webkit-perspective: 1000px;
    -webkit-backface-visibility: visible;
    backface-visibility: visible;
    transition: opacity 0.3s, visibility 0s;
}

#sfal-popup-<?php echo $streamID ?>.sfal-popup-open {
    opacity: 1;
    visibility: visible;
    transition: opacity 0.3s;
    z-index: 10000;
}

#sfal-popup-<?php echo $streamID ?> .sfal-close-popup-container {
    position: fixed;
    top: 0;
    right: 0;
    background: rgba(51, 51, 51, 0);
    z-index: 9999;
}

#sfal-popup-<?php echo $streamID ?> .sfal-close-popup {
    background: rgba(102, 102, 102, 0);
    border: none;
    padding: 50px 20px;
}

#sfal-popup-<?php echo $streamID ?> .sfal-close-popup i {
    color: #fff;
    font-size: 30px;
    cursor: pointer;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-wrapper.swiper-wrapper {
    max-width: 815px;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-container {
  width: 80%;
  height: 85%;
  max-height: 800px;
  overflow: hidden;
  border-radius: 5px;
  -ms-transform: translate(-50%, -50%);
  -webkit-transform: translate(-50%, -50%);
  -moz-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  position: absolute;
  left: 50%;
  top: 50%;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-media-wrapper,
#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-media-wrapper .swiper-container {
  height: 100%;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item {
  height: 850px;
}


#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-media-img {
    width: 100%;
    height: 100%;
    position: relative;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-media-img img {
    width: 100%;
    height: 100%;
    object-fit: fill;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-media-video,
#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-media-video video {
    width: 100%;
    height: 100%;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-media-video {
    background-color: #000;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-media-video video {
  object-fit: cover;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-media-img img.sfal-lazy-img {
    background-color: #000;
    background-image: url(<?php echo $assetsUrl ?>/img/user/oval.svg);
    background-repeat: no-repeat;
    background-position: 50% 50%
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-content-header {
    width: 100%;
    display: block;
    position: relative;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-header-img {
    float: left;
    margin-right: 10px;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-header-img>img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-header-meta {
    line-height: 18px;
    margin-top: 10px;
    float: left;
    margin-left: 5px;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-account-title {
    font-size: 19px;
    font-weight: 600;
    color: <?php echo $options->general->color->popup->text; ?>;
    display: block;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-header-meta .sfal-popup-item-account-url,
#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-header-meta .sfal-popup-item-account-date {
    font-size: 13px;
    color: <?php echo $options->general->color->popup->text; ?>;
    display: inline-block;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-account-url {
    white-space: nowrap;
    overflow: hidden;
    -o-text-overflow: ellipsis;
    -ms-text-overflow: ellipsis;
    text-overflow: ellipsis;
    max-width: 90px;
    vertical-align: -4px;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-header-dropdown {
    float: right;
    margin-top: 11px;
    margin-right: 3px;
    position: relative;
    cursor: pointer;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-header-external-link {
  vertical-align: middle;
  padding: 7px 14px;
  border-radius: 2px;
  color: #fff;
  text-transform: uppercase;
  font-size: 11px;
  background: <?php echo $options->general->color->popup->followBtn; ?>;
  display: inline-block;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-header-dropdown-share-links {
    padding: 8px 9px 0px;
    margin: 0 0 0 4px;
    vertical-align: middle;
    display: inline-block;
    height: 33px;
    box-sizing: border-box;
    border-radius: 2px;
    color: #fff;
    font-size: 15px;
    text-decoration: none;
    line-height: 1;
    background: <?php echo $options->general->color->popup->followBtn; ?>;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-content-wrapper {
  background: #f1f1f1;
  overflow-y: scroll;
  height: 100%;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-content {
  padding: 20px;
  margin: 0;
  background: <?php echo $options->general->color->popup->background; ?>;
  white-space: initial;
  box-sizing: border-box;
  height: auto;
  border-bottom: 1px solid #ecebea;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-content-text {
    line-height: 27px;
    padding: 15px 0 0 0;
    font-size: 15px;
    color: <?php echo $options->general->color->popup->text; ?>;
    height: auto;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-content-text a {
  color: <?php echo $options->general->color->popup->links; ?>;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-content-meta {
    width: 100%;
    white-space: nowrap;
    padding: 15px 0 0 0;
    height: auto;
    font-size: 15px;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-like-counter-meta {
    margin-right: 27px;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-like-counter-meta,
#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-comment-counter-meta {
    color: <?php echo $options->general->color->popup->text; ?>;
    opacity: 0.75;
    outline: none;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-like-counter-meta>i,
#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-comment-counter-meta>i {
    vertical-align: -2px;
    margin-right: 2px;
    font-weight: bold;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-location-meta {
    color: <?php echo $options->general->color->popup->text; ?>;;
    margin: 0 0 0 21px;
    font-weight: 600;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-date-meta {
    float: right;
    color: <?php echo $options->general->color->popup->text; ?>;;
    font-size: 15px;
    font-weight: 600;
    display: block;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-comments {
  font-size: 15px;
  position: relative;
  background: <?php echo $options->general->color->popup->commentsBackground; ?>;
  min-height: 100%;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-comments-container {
  padding: 25px 35px 15px;
  height: auto;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-comments-slide-comment {
    padding: 0 0 10px 0;
    line-height: 1.8;
    color: <?php echo $options->general->color->popup->commentsText; ?>;
    opacity: 1;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-comments-slide-comment-text a {
  color: <?php echo $options->general->color->popup->links; ?>;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-comments-slide-comment-username {
    margin: 0 5px 0 0;
    color: <?php echo $options->general->color->popup->commentsText; ?>;
    font-weight: bold;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-view-all-slide {
    font-weight: bold;
    color: <?php echo $options->general->color->popup->commentsText; ?>;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-comment-not-exist {
    color: <?php echo $options->general->color->popup->commentsText; ?>;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-comment-not-exist > a {
    font-weight: bold;
    margin-left: 5px;
    color: <?php echo $options->general->color->popup->commentsText; ?>;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-header-share-links {
    position: absolute;
    top: 42px;
    background-color: #ffffff;
    right: -6px;
    padding: 10px 7px;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.27);
    transition: all 0.2s ease-in;
    opacity: 0;
    z-index: 10;
    visibility: hidden;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-header-share-links.show-share-links {
    opacity: 1;
    visibility: visible;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-header-share-links::after {
    content: "";
    position: absolute;
    top: 0px;
    left: 68%;
    width: 0;
    height: 0;
    border: 7px solid #fff0;
    border-top-color: rgba(255, 255, 255, 0);
    border-top-style: solid;
    border-top-width: 7px;
    border-bottom-width: 7px;
    border-bottom-color: rgba(0, 0, 0, 0);
    border-bottom-style: solid;
    border-bottom-color: #f2f2f2;
    border-top: 0;
    margin-right: -7px;
    margin-top: -7px;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-header-share-links a {
    color: #484848;
    padding: 6px 2px;
    display: block;
    text-decoration: none !important;
    outline: none !important;
    box-shadow: none;
    font-size: 13px;
}

#sfal-popup-<?php echo $streamID ?> .sfal-popup-item-header-share-links a i {
    font-size: 14px;
    vertical-align: -1px;
    margin-right: 5px;
}

#sfal-popup-<?php echo $streamID ?> .sfal-media-next-item,
#sfal-popup-<?php echo $streamID ?> .sfal-media-prev-item {
  background-image: url("<?php echo $assetsUrl ?>/img/user/arrow.png");
  width: 30px;
  height: 30px;
  background-size: contain;
}

#sfal-popup-<?php echo $streamID ?> .sfal-media-next-item:after,
#sfal-popup-<?php echo $streamID ?> .sfal-media-prev-item:after {
  content: "";
}

#sfal-popup-<?php echo $streamID ?> .sfal-media-next-item {
  transform: rotate(180deg)
}

#sfal-popup-<?php echo $streamID ?> .swiper-pagination-bullet {
  width: 6px;
  height: 6px;
}

#sfal-popup-<?php echo $streamID ?> .swiper-container-horizontal > .swiper-pagination-bullets .swiper-pagination-bullet {
  margin: 0 2px;
}

/* end popup */

<?php endif; ?>

@media (max-width: 960px) {
    #sfal-stream-<?php echo $streamID ?> .sfal-stream-searchbox-container p.sfal-stream-searchbox {
        width: 60%;
    }
    #sfal-popup-<?php echo $streamID ?> .sfal-popup-wrapper.swiper-wrapper {
        max-width: 850px;  
    }
    #sfal-popup-<?php echo $streamID ?> .sfal-popup-item {
        height: 690px;
    }
    #sfal-popup-<?php echo $streamID ?> .sfal-popup-item-container {
        width: 88%;
        height: 90%;
    }
}

@media (max-width: 480px) {
    #sfal-stream-<?php echo $streamID ?> .sfal-stream-searchbox-container p.sfal-stream-searchbox {
        width: 90%;
    }
    #sfal-popup-<?php echo $streamID ?> {
        padding: 0;
    }
}
<?php echo $styles; ?>
<?php echo esc_textarea($options->general->customCss) ?>
