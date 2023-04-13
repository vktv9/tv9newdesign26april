<script>
// Lazy Load Images using Intersection Observer
(function () 
{
	var observer = new IntersectionObserver(onIntersect);
	document.querySelectorAll(".lazy").forEach((img) => 
	{
		observer.observe(img);
	});
	document.querySelectorAll(".lozad").forEach((img) => 
	{
		observer.observe(img);
	});
	document.querySelectorAll("[data-lazy]").forEach((img) => 
	{
		observer.observe(img);
	});
	function onIntersect(entries) 
	{
		entries.forEach((entry) => 
		{
			if (entry.target.getAttribute("data-processed") || !entry.isIntersecting)
				return true;
			entry.target.setAttribute("src", entry.target.getAttribute("data-src"));
			entry.target.setAttribute("data-processed", true);
		});
	}
})();
</script>
</body></html>