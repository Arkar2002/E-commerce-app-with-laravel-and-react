function Container({ children, classname = "" }) {
  return <div className={`container mb-10 ${classname}`}>{children}</div>;
}

export default Container;
