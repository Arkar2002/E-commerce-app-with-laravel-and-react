function Heading({
  children,
  size = "default",
  weight = "default",
  textColor = "text-gray-800",
  classname = "mb-5",
}) {
  const fontSize = {
    default: "text-2xl",
    sm: "text-md",
    base: "text-lg",
    md: "text-3xl",
    lg: "text-4xl",
  };

  const fontWeight = {
    default: "font-medium",
    semibold: "font-semibold",
    bold: "font-bold",
  };

  return (
    <div
      className={`${fontSize[size]} ${fontWeight[weight]} uppercase ${textColor} ${classname}`}
    >
      {children}
    </div>
  );
}

export default Heading;
