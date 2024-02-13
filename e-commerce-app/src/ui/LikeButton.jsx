import IconButton from "./IconButton";

function LikeButton({ to = "", icon, onClick, disabled = false }) {
  return (
    <IconButton onClick={onClick} to={to} disabled={disabled}>
      {icon}
    </IconButton>
  );
}

export default LikeButton;
