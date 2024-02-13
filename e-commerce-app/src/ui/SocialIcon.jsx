function SocialIcon({ icon, ...props }) {
  return (
    <a
      {...props}
      className="text-primary opacity-95 transition hover:text-gray-800"
      target="_blank"
    >
      {icon}
    </a>
  );
}

export default SocialIcon;
