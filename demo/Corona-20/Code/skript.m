batchload("BasicData.txt");
load("lsquares");
f(t):=exp(c-((t-m)/s)^2);  /* Gauss distribution */
g(t):=c-((t-m)/s)^2;       /* log of Gauss distribution */
h(t):=0.8862*exp(c)*s*(erf((t-m)/s)+erf(m/s)); /* Error function */

/* Extract increment list \Delta(S)=[s_i-s_{i-1},i=1..len(S)] from a list */
Delta(l):=l-append([0],reverse(rest(reverse(l))))$

/* Collect data for a given country into a single nested list */
getData(Land):=block([u,I,R,D],
  u:Land[infected],
  I:makelist([i+21,u[i]],i,1,length(u)),
  u:Land[recovered],
  R:makelist([i+21,u[i]],i,1,length(u)),
  u:Land[dead],
  D:makelist([i+21,u[i]],i,1,length(u)),
[I,R,D])$

/* == Fitting procedure == */
	 
FittingDelta(G,tr):=block([G1,G2,G3,G4,G5],
  /* tr is a lower threshold for data to be counted
     from the list of increments */ 
  /* Compute the Deltas */
  G1:map("[",map(first,G),Delta(map(second,G))),
  /* Filter out small entries */
  G2:sublist(G1,lambda([u],second(u)>tr)),
  /* Compute the log data */
  G3:map(lambda([u],[first(u),float(log(second(u)))]),G2),
  /* Compute the parameter estimation */
  G4:apply('matrix,G3),
  lsquares_estimates(G4,[t,y],y=g(t),[c,s,m])
)$

/* ====== Functions to compute the Fittings =============== */

getFittingFunctions(l,tr):=block([G,est],
  /* tr is a lower threshold for data to be counted
     from the list of increments */ 
  G:l[1],
  est:FittingDelta(G,tr),
  define(h1(t),subst(float(first(est)),h(t))),
  G:l[2],
  est:FittingDelta(G,tr),
  define(h2(t),subst(float(first(est)),h(t))),
  G:l[3],
  est:FittingDelta(G,tr),
  define(h3(t),subst(float(first(est)),h(t))),
  [h1(t),h2(t),h3(t)])$

/* ====== Functions to compute the Fittings =============== */

createPlot(l,max):=block([G1,G2,G3],
  G1:l[1], G2:l[2], G3:l[3],
  plot2d([[discrete, G1], h1(t), [discrete, G2], h2(t), [discrete, G3], h3(t)], 
  [t,0,200], [y,0,max],
  [style, points, lines], [legend, false],
  [color, red, red, green, green, blue, blue])
)$

/* ==== Italy ===== */

l:getData(Italy);
getFittingFunctions(l,50);
createPlot(l,5*10^5);

[72446.77939732558 (erf(0.06799076073287293 (t - 85.26758010923094)) + 1.0),
 19954.75123858321 (erf(0.05447733565402062 (t - 94.13429784558038)) + 1.0),
 11446.53620856779 (erf(0.06432839216420218 (t - 89.96730170335502)) + 1.0)]

/* ==== Spain ===== */

l:getData(Spain);
getFittingFunctions(l,50);
createPlot(l,5*10^5);

G1:l[1]; G2:l[2]; G3:l[3];

plot2d([[discrete, G1], h1(t)],
[t,0,200], [y,0,1.5*10^4],
[style, points, lines], [legend, false],
[color, red, red]);


bad fitting for h2
[78444.57631517828 (erf(0.08691988157660947 (t - 89.43091102808097)) + 1.0),
 89251.4662590775 (erf(0.01077787846363871 (t - 29.63034168876397)) +
 0.3484660619227326), 11689.03759638845 (erf(0.0810813440036071 (t -
 94.7178929420294)) + 1.0)]

/* ==== Germany ===== */

l:getData(Germany);
getFittingFunctions(l,50);
createPlot(l,2*10^5);

[85636.7778943634 (erf(0.06975466171038898 (t - 94.0781920706715)) + 1.0),
 10365.01925718878 (erf(0.1892685639671348 (t - 90.16504258370512)) + 1.0),
 1311.80981845294 (erf(0.1042031139604201 (t - 95.18435475991847)) + 1.0)]

/* ==== Austria ===== */

l:getData(Austria);
getFittingFunctions(l,10);
createPlot(l,3*10^4);

good fitting only for h1
[6873.439448181585 (erf(0.09167412601048296 (t - 87.64941516477582)) + 1.0),
 115972.3432259248 (erf(0.02197867958311569 (t - 13.32239597896194)) +
 0.3211947301828582), 1.375619727957205E+7 (erf(0.03953873232096636 (t -
 7.709136631650753)) + 0.3335794106179681)]

