import { Link } from "react-router-dom";

function Button({
  children,
  size = "default",
  to = false,
  display = "inline-block",
  className = "",
  onClick = null,
  type = "primary",
}) {
  const btnSize = {
    default: "px-2 py-3",
    sm: "px-2 py-1",
    md: "px-8 py-2",
  };

  const btnClass = `${display} rounded-md ${type === "primary" ? "bg-primary text-gray-100" : "bg-transparent text-gray-600"} ${btnSize[size]} border-primary hover:text-primary border transition hover:bg-transparent text-xs md:text-sm hover:opacity-90 focus:ring-2 ${className} text-center`;

  if (to) {
    return (
      <Link to={to} className={btnClass}>
        {children}
      </Link>
    );
  }

  return (
    <button onClick={onClick} className={btnClass}>
      {children}
    </button>
  );
}

export default Button;
