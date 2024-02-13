import { Link } from "react-router-dom";

function IconButton({ children, to = "", onClick, disabled = false }) {
  function handleClick(e) {
    e.preventDefault();
    onClick?.();
  }

  if (to) {
    return (
      <Link
        to={to}
        className="flex h-9 w-9 items-center justify-center rounded-full bg-primary text-lg text-white hover:bg-gray-800"
      >
        {children}
      </Link>
    );
  } else {
    return (
      <button
        type="button"
        onClick={handleClick}
        className="flex h-9 w-9 items-center justify-center rounded-full bg-primary text-lg text-white hover:bg-gray-800"
        disabled={disabled}
      >
        {children}
      </button>
    );
  }
}

export default IconButton;
