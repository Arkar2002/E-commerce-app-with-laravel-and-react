function Feature() {
  const featureClass = {
    container:
      "border-primary flex items-center justify-center gap-5 rounded-sm border px-3 py-6",
    image: "h-12 w-12 object-contain",
    text1: "text-lg font-medium capitalize",
    text2: "text-sm text-gray-500",
  };

  return (
    <div className="container py-10">
      <div className="mx-auto grid w-10/12 justify-center gap-6 md:grid-cols-3">
        <div className={featureClass.container}>
          <img
            src="/images/icons/delivery-van.svg"
            className={featureClass.image}
            alt=""
          />
          <div>
            <div className={featureClass.text1}>Free Shoping</div>
            <p className={featureClass.text2}>Order Over $200</p>
          </div>
        </div>

        <div className={featureClass.container}>
          <img
            src="/images/icons/money-back.svg"
            className={featureClass.image}
            alt=""
          />
          <div>
            <div className={featureClass.text1}>Money returns</div>
            <p className={featureClass.text2}>30 Days money return</p>
          </div>
        </div>

        <div className={featureClass.container}>
          <img
            src="/images/icons/service-hours.svg"
            className={featureClass.image}
            alt=""
          />
          <div>
            <div className={featureClass.text1}>24/7 Support</div>
            <p className={featureClass.text2}>Customer Support</p>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Feature;
